<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use Translatable;
    protected $with = ['translations']; // the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    public $translatedAttributes = ['name'];

    protected $fillable = ['parent_id', 'is_active', 'slug', 'photo'];
    protected $hidden = ['translations'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function mainParent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function getActive()
    {
        # code...
        return $this->is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

    public function scopeSelection($query)
    {

        return $query->select('id', 'parent_id', 'is_active', 'slug');
    }

    public function _parent()
    {

        return $this->belongsTo(self::class, 'parent_id');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/categories/' . $val) : "";

    }

    public function scopeActive($q)
    {
        # code...
        return $q->where('is_active', 0);
    }
}