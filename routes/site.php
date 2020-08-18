<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php
/*
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
  /*  Route::get('/', function()
    {
        return View::make('hello');
    });

    Route::get('test',function(){
        return View::make('test');
    });
});
  */
Route::group(['namespace'=>'Site'], function(){
    Route::get('/login',function (){
        return "This is Not  site , please Login ";
    })->name("login");
});

