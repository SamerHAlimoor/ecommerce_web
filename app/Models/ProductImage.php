<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    public $translatedAttributes = ['name'];

    protected $fillable = ['parent_id', 'is_active', 'slug', 'photo'];
    protected $hidden = ['translations'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}