<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mpesa extends Model
{
    protected $fillable=[
        'service_name','business_number','transaction_reference','internal_transaction_id','transaction_timestamp','transaction_type',"other",
        'account_number','sender_phone','first_name','middle_name','last_name','amount','currency','signature','user_id','is_valid','usedflg'
    ];

    protected $hidden=['created_at','updated_at'];


    static function createFromSafcom($data){
        /*
         `TransactionType`, `TransID`, `TransTime`, `TransAmount`, `BusinessShortCode`,
         `BillRefNumber`, `InvoiceNumber`, `OrgAccountBalance`, `ThirdPartyTransID`, `MSISDN`,
            `FirstName`, `MiddleName`, `LastName`, `trans_time`
         */
        $payment=self::query()->create([
            'service_name'=>"MPESA",
            'business_number'=>$data['BusinessShortCode'],
            'transaction_reference'=>$data['TransID'],
            'internal_transaction_id'=>$data['InvoiceNumber'],
            'transaction_timestamp'=>$data['TransTime'],
            'transaction_type'=>$data['TransactionType'],
            'account_number'=>$data['BillRefNumber'],
            'sender_phone'=>$data['MSISDN'],
            'first_name'=>$data['FirstName'],
            'middle_name'=>$data['MiddleName'],
            'last_name'=>$data['LastName'],
            'amount'=>$data['TransAmount'],
            'currency'=>"KES",
            'signature'=>"",
            'user_id'=>0,
            'is_valid'=>true,
            'usedflg'=>false,
            "other"=>$data['BillRefNumber']
        ]);

        return $payment;
    }
}
