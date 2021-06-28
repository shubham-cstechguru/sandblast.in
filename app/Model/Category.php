<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    public $timestamps      = false;
    protected $table 		= "categories";
    protected $primaryKey 	= "category_id";

    public function scats() {
        return $this->hasMany( 'App\Model\Category', 'category_parent', 'category_id' );
    }
    public function products() {
        return $this->hasMany( 'App\Model\ProductModel', 'product_category', 'category_id' );
    }
}
