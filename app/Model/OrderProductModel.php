<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WishlistModel as Wishlist;

class OrderProductModel extends Model {
    public      $timestamps     = false;
    protected   $table 		    = "order_products";
    protected   $primaryKey 	= "opro_id";

    public function product() {
        return $this->hasOne('App\Model\ProductModel', 'product_id', 'opro_pid');
    }
}
