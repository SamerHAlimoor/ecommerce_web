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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::group(['namespace'=>'Dashborad','middleware'=>'auth:admin','prefix'=>'admin'], function()
    {



        Route::get('/','DashboradController@index' )->name('admin.dashboard');
        Route::get('/logout','LoginController@logout')->name("admin.logout");

        Route::group(['prefix'=> 'settings'],function (){
            Route::get('/shippings-method/{type}','SettingController@editShippingMethods' )->name('edit.shippings.methods');
            Route::put('/shippings-method/{id}','SettingController@updateShippingMethods' )->name('update.shippings.methods');

        });

        Route::group(['prefix'=> 'profile'],function (){
            Route::get('/edit','ProfileController@editProfile' )->name('profile.edit');
            Route::put('/update','ProfileController@updateProfile' )->name('profile.update');
        });




    });

    Route::group(['namespace'=>'Dashborad','middleware'=>'guest:admin','prefix'=>'admin'], function(){
        Route::get('/login','LoginController@login')->name("admin.login");
        Route::post('/login','LoginController@loginDashboard')->name("admin.loginDashboard");

    });
});



