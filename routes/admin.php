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

##########################################  Start   Main Categories      #########################################
        Route::group(['prefix' => 'main-categories'], function () {
            Route::get('/', 'MainCategoriesController@index')->name('admin.main.categories');
            Route::get('create', 'MainCategoriesController@create')->name('admin.main.categories.create');
            Route::post('store', 'MainCategoriesController@store')->name('admin.main.categories.store');

            Route::get('edit/{id}','MainCategoriesController@edit') -> name('admin.main.categories.edit');
            Route::post('update/{id}','MainCategoriesController@update') -> name('admin.main.categories.update');

            Route::get('delete/{id}','MainCategoriesController@destroy') -> name('admin.main.categories.delete');
         //   Route::get('changeStatus/{id}','MainCategoriesController@changeStatus') -> name('admin.main.categories.status');



        });

##########################################  End   Main Categories    #########################################
################################## sub categories routes ######################################
        Route::group(['prefix' => 'sub-categories'], function () {
            Route::get('/','SubCategoriesController@index') -> name('admin.subcategories');
            Route::get('create','SubCategoriesController@create') -> name('admin.subcategories.create');
            Route::post('store','SubCategoriesController@store') -> name('admin.subcategories.store');
            Route::get('edit/{id}','SubCategoriesController@edit') -> name('admin.subcategories.edit');
            Route::post('update/{id}','SubCategoriesController@update') -> name('admin.subcategories.update');
            Route::get('delete/{id}','SubCategoriesController@destroy') -> name('admin.subcategories.delete');
        });

        ################################## end categories    #######################################



    });

    Route::group(['namespace'=>'Dashborad','middleware'=>'guest:admin','prefix'=>'admin'], function(){
        Route::get('/login','LoginController@login')->name("admin.login");
        Route::post('/login','LoginController@loginDashboard')->name("admin.loginDashboard");

    });
});



