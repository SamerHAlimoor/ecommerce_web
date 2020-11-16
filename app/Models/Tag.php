<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    //
    use Translatable;
    protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    public $translatedAttributes = ['name'];

    protected $fillable = ['slug'];
    protected $hidden = ['translations'];

    public function scopeSelection($query)
    {

        return $query->select('id', 'name');
    }
    public function scopeActive($q)
    {
        # code...
        return $q->select('id', 'name');
    }
}