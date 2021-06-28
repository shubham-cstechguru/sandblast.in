<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model {
    public      $timestamps     = false;
    protected   $table 		    = "product_prices";
    protected   $primaryKey 	= "price_id";

    public function product() {
        return $this->hasOne('App\Model\ProductModel', 'product_id', 'price_pid');
    }
}
