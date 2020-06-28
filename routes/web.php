<?php

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

use Illuminate\Auth\Events\Verified;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/walid', function () {
    return view('portfolio');
});
Route::get('/about', function () {
    return view('about');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->Middleware('verified');

Route::get('fillable', 'CrudController@getOffers');

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => 'offers'], function () {
        //Route::get('store', 'CrudController@store');
        Route::get('create', 'CrudController@create');
        Route::get('all', 'CrudController@getOffers');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
    });
});
