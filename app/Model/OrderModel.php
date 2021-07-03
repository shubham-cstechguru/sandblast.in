<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WishlistModel as Wishlist;

class OrderModel extends Model
{
    public    $timestamps   = false;
    protected $table         = "orders";
    protected $primaryKey     = "order_id";

    public function order_products()
    {
        return $this->hasMany('App\Model\OrderProductModel', 'opro_oid', 'order_id');
    }

    public function product()
    {
        return $this->hasOne('App\Model\ProductModel', 'product_id', 'order_pid');
    }
}
