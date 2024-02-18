<?php

namespace App\Http\Controllers;

use App\MerchantConfig;
use App\MobileWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MobileWalletController extends Controller
{

    public function paymentReceived(Request $request)
    {
        $data_back = json_decode($request->getContent());
        //values contained//this is just to show you values contained on the payload
        $data['service_name'] = $data_back->{"service_name"};
        $data['business_number'] = $data_back->{"business_number"};
        $data['transaction_reference'] = $data_back->{"transaction_reference"};
        $data['internal_transaction_id'] = $data_back->{"internal_transaction_id"};
        $data['transaction_timestamp'] = $data_back->{"transaction_timestamp"};
        $data['transaction_type'] = $data_back->{"transaction_type"};
        $data['account_number'] = $data_back->{"account_number"};
        $data['sender_phone'] = $data_back->{"sender_phone"};
        $data['first_name'] = $data_back->{"first_name"};
        $data['middle_name'] = $data_back->{"middle_name"};
        $data['last_name'] = $data_back->{"last_name"};
        $data['amount'] = $data_back->{"amount"};
        $data['currency'] = $data_back->{"currency"};
        $data['signature'] = $data_back->{"signature"};

        //replace any null value with empty string
        foreach ($data as $key => $value) {//see this id $data not $data_back
            if ($value == null) {
                $data[$key] = "N/A";
            }
        }

        $payment = MobileWallet::query()->create($data);

        /**
         * validate signature
         */
        if ($this->validateTransaction($data_back)) {
            /**
             * valid transaction from kopokopo, save it
             */
        } else {
            /**
             * not valid transaction discard or add to invalid payments
             * for reference so we can know who is doing bad shiet here
             */
        }

        //Respond to the callback api
        $res = [
            "status" => "01",
            "description" => "Accepted",
            "subscriber_message" => ""
        ];

        return response()->json($res);
    }

    function validateTransaction($data)
    {
        $key_array = ["account_number", "amount", "business_number", "currency", "first_name",
            "internal_transaction_id", "last_name", "middle_name", "sender_phone", "service_name",
            "transaction_reference", "transaction_timestamp", "transaction_type"];

        $secret_key = "fe3502457d08c217f8b496448a84a9061b800ee0";
        $data_string = "";
        foreach ($key_array as $key) {
            $data_string .= $key . "=" . ($data->$key) . "&";
        }
        $data_string = substr($data_string, 0, strlen($data_string) - 1);

        $new_signature = base64_encode(hash_hmac("sha1", $data_string, $secret_key, TRUE));

        return $new_signature == $data->signature;
    }

    public function generateLiveToken($config) {

        $consumer_key = $config->consumer_key;
        $consumer_secret = $config->consumer_secret;

        if (!isset($consumer_key) || !isset($consumer_secret)) {
            return response()->json("please declare the consumer key and consumer secret as defined in the documentation",402);
        }
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $curl_response = curl_exec($curl);

        return json_decode($curl_response)->access_token;
    }


    public function registerTenantShortcode(Request $request) {
        $config=MerchantConfig::query()->find($request->post("tenant"));
        if(!$config)
            return response()->json("Tenant config not fount",402);

        $token = $this->generateLiveToken($config);
        if(!is_string($token)){
            return $token;
        }
        $url = 'https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));


        $post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => $config->short_code,
            'ResponseType' => 'application/json',
            'ConfirmationURL' => url('api/mobile/wallet/confirm'),
            'ValidationURL' => url('api/mobile/wallet/validate')
        );

        $data_string = json_encode($post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $curl_response = curl_exec($curl);

        return $curl_response;
    }


    /*
     * Validate funds sent direct from lipa na mpesa
     */
    public function validateMpesa(Request $request)
    {
        return $this->finishTransaction();
    }

    /*
     * Payment recieved from customer direct payment to mpesa paybill
     */
    public function confirm(Request $request)
    {
        $data = $request->json()->all();
        MobileWallet::createFromSafcom($data);

        return $this->finishTransaction();
    }

    public function finishTransaction()
    {
        $resultArray = [
            "ResultDesc" => "Confirmation Service request accepted successfully",
            "ResultCode" => "0"
        ];

        return response()->json($resultArray);
    }

    public function getLivePayments(Request $request){
        $user_id =$request->get('q');
        if(!$user_id)
            return response()->json("login to continue",401);

        $merchant=MerchantConfig::query()->find($user_id);
        if(!$merchant)
            return response()->json("No payment configs for merchant",402);
    
        return response()->json(
            MobileWallet::query()->where("business_number","=",$merchant->short_code)
            ->get()
        );
    }
}
