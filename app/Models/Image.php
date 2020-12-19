<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Image extends Model
{

    protected $fillable = ['product_id', 'imageable_id', 'imageable_type', 'photo'];
}
