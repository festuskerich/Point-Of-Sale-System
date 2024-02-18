<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobileWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("service_name");
            $table->bigInteger("user_id")->unsigned()->default(0);
            $table->string("business_number");
            $table->string("transaction_reference")->unique();
            $table->string("internal_transaction_id")->nullable();
            $table->string("transaction_timestamp")->nullable();
            $table->string("transaction_type")->nullable();
            $table->string("account_number")->nullable();
            $table->string("sender_phone");
            $table->string("first_name")->nullable();
            $table->string("middle_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("amount");
            $table->string("currency");
            $table->string("signature")->nullable();
            $table->boolean("is_valid")->default(false);
            $table->boolean("usedflg")->default(0);
            $table->mediumText("other")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobile_wallets');
    }
}
