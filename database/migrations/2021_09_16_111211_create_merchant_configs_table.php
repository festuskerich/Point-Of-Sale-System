<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("tenant_id");
            $table->string("short_code");
            $table->string('consumer_key')->nullable();
            $table->string('consumer_secret')->nullable();
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
        Schema::dropIfExists('merchant_configs');
    }
}
