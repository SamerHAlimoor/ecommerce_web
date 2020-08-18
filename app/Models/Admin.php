<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $table="admins";
   // protected $fillable = ['name', 'email', 'password',];
    //protected $hidden = ['password', 'created_at','updated_at'];
    protected  $guarded=[];
    public  $timestamps=true;


}
