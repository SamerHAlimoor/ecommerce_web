<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_verification extends Model
{
    public $table = "users_verification";
    //
    // protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    // public $translatedAttributes = ['name'];

    protected $fillable = ['user_id', 'code', 'created_at', 'updated_at'];
    // protected $hidden = ['translations'];

}