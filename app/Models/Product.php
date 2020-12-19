<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use Translatable, SoftDeletes;
    protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation

    protected $fillable = [
        'brand_id', 'slug', 'sku', 'price', 'special_price', 'special_price_type',
        'special_price_start', 'special_price_end', 'selling_price', 'manage_stock', 'qty', 'in_stock', 'is_active',

    ];
    protected $hidden = ['translations'];
    protected $casts = [
        'is_active' => 'boolean',
        'in_stock' => 'boolean',
        'mange_stock' => 'boolean',
    ];
    protected $dates = [
        'special_price_start', 'special_price_end', 'deleted_at',
    ];
    public $translatedAttributes = ['name', 'description', 'short_description'];

    public function brands()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function getActive()
    {
        # code...
        return ($this->is_active == 0) ? 'غير مفعل ' : ' مفعل';
    }
    public function scopeSelection($query)
    {

        return $query->select('id', 'name');
    }
}
