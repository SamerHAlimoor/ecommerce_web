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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'guest'], function () {
        //guest  user

    });

    Route::group(['middleware' => ['auth']], function () {
        // must be authenticated user and verified
        Route::get('profile', function () {
            return 'You Are Authenticated ';
        });
    });

});