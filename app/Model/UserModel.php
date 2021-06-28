<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model {
    public    $timestamps   = false;
    protected $table 		= "users";
    protected $primaryKey 	= "user_id";
}
