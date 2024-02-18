<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantConfig extends Model
{
    protected $fillable = ["tenant_id","short_code","consumer_key","consumer_secret"];
}
