<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model {
    public      $timestamps     = false;
    protected   $table 		    = "products";
    protected   $primaryKey 	= "product_id";

    public function prices() {
        return $this->hasMany('App\Model\ProductPrice', 'price_pid', 'product_id');
    }
    public function cat() {
        return $this->hasOne('App\Model\Category', 'category_id', 'product_category');
    }
    public function scat() {
        return $this->hasOne('App\Model\Category', 'category_id', 'product_subcategory');
    }
    public function city() {
        return $this->hasOne('App\Model\CityModel', 'city_id', 'product_city');
    }
    public function country() {
        return $this->hasOne('App\Model\CountryModel', 'country_id', 'product_country');
    }
}
