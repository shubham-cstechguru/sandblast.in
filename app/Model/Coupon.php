<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    public    $timestamps   = false;
    protected $table 		= "coupons";
    protected $primaryKey 	= "coupon_id";
}
