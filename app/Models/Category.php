<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use Translatable;
    protected  $with=['translations'] ;// the name of table is  setting_translations and you will cutt the translation that you want to link the translation
    public $translatedAttributes=['name'];

    protected $fillable=['parent_id','is_active','slug'];
    protected $hidden=['translations'];
    protected $casts=[
        'is_active'=>'boolean'
    ];
public  function  scopeParent($query){
return $query->whereNull('parent_id');
}
    public  function  scopeChild($query){
        return $query->whereNotNull('parent_id');
    }

    public function getActive()
    {
        # code...
        return  $this->is_active == 1 ? 'مفعل' : 'غير مفعل';
    }

}
