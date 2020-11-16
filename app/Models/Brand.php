<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    //
    use Translatable;
    protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    public $translatedAttributes = ['name'];

    protected $fillable = ['is_active', 'photo'];
    protected $hidden = ['translations'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function getActive()
    {
        # code...
        return ($this->is_active == true) ? 'غير مفعل ' : ' مفعل';
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "";

    }
    public function scopeSelection($query)
    {

        return $query->select('id', 'is_active', 'photo');
    }
    public function scopeActive($q)
    {
        # code...
        return $q->where('is_active', 0);
    }

}