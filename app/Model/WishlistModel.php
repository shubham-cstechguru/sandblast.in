<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\WishlistModel as Wishlist;

class WishlistModel extends Model {
    protected $table 		= "wishlist";
    protected $primaryKey 	= "wish_id";
}