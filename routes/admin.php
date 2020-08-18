<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ِAdmin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php

Route::group(['namespace'=>'Dashborad','middleware'=>'auth:admin','prefix' => LaravelLocalization::setLocale()], function()
{
    /*
//    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
//    Route::get('/', function()
//    {
//        return View::make('hello');
//    });
//
//    Route::get('test',function(){
//        return View::make('test');
   // });
  /*  Route::get('/', function () {
        return view('welcome');
    });*/
    Route::get('/','DashboradController@index' )->name('admin.dashboard');





});

Route::group(['namespace'=>'Dashborad','middleware'=>'guest:admin'], function(){
    Route::get('/login','LoginController@login')->name("admin.login");
    Route::post('/login','LoginController@loginDashboard')->name("admin.loginDashboard");

});


