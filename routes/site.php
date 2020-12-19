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
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {



    Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {
        //guest  user
        route::get('/','HomeController@home') -> name('home') -> middleware('VerifiedUser');
        route::get('category/{slug}','CategoryController@productsBySlug') ->name('category');

    });


    Route::group(['namespace' => 'Site', 'middleware' => ['auth','VerifiedUser']], function () {
                    // must be authenticated user and verified
        Route::get('profile',function(){
            return 'You Are Authenticated ';
        });
    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user
        Route::post('verify-user/', 'VerificationCodeController@verify') -> name('verify-user');
        Route::get('verify','VerificationCodeController@getVerifyPage') -> name('get.verification.form');
    });

});