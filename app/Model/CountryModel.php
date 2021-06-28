<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model {
    public      $timestamps    = false;
    protected   $table 		   = "countries";
    protected   $primaryKey    = "country_id";
}
