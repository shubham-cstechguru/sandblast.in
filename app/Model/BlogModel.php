<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model {
    protected $table 		= "posts";
    protected $primaryKey 	= "post_id";
}
