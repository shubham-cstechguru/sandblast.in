<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model {
    public      $timestamps     = false;
    protected   $table 		    = "cities";
    protected   $primaryKey 	= "city_id";

}
