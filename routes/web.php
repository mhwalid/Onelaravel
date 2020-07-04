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
        Route::get('all', 'CrudController@getOffers')->name('offers.all');
        Route::post('store', 'CrudController@store')->name('offers.store');
        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}', 'CrudController@delete')->name('offers.delete');
    });
    Route::get('youtube', 'CrudController@getVideo')->middleware('auth');
});
// ajax
Route::group(['prefix' => 'ajax-offers'], function () {
    Route::get('create', 'offerController@create');
    Route::post('store', 'offerController@store')->name('ajax.offers.store');
    Route::get('all', 'offerController@all')->name('ajax.offers.all');
    Route::post('delete', 'offerController@delete')->name('ajax.offers.delete');
    Route::post('update', 'offerController@update')->name('ajax.offers.update');
    Route::get('edit/{offer_id}', 'offerController@edit')->name('ajax.offers.edit');
});
###############################"" auth
Route::group(['middleware' => 'chackAge', 'namespace' => 'Auth'], function () {
    Route::get('adult', 'CustomAuthController@adult');
});
Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth')->name('site');
Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
Route::get('admin/login', 'Auth\CustomAuthController@adminlogin')->name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkadminlogin')->name('save.admin.login');



##################"" relation 
Route::get('has-one', 'Relation\RelationController@hasOneRelation');
Route::get('has-oneRevers', 'Relation\RelationController@hasOneRelationRevers');

###########"" one to many
Route::get('hospital-has-many', 'Relation\RelationController@gethospitalDoctors');
Route::get('hospitals', 'Relation\RelationController@hospitals')->name('hospital.all');

Route::get('doctors/{hospital_id}', 'Relation\RelationController@doctors')->name('hospital.doctors');

Route::get('hospitals-has-doctors', 'Relation\RelationController@hospitalsHasDoctor');

Route::get('hospitals-has-doctors_male', 'Relation\RelationController@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals-not-has-doctors', 'Relation\RelationController@hospitals_not_has_doctors');

Route::get('hospital/{hospital_id}', 'Relation\RelationController@deletHospital')->name('hospital.delete');


########################## many to many 

Route::get('doctors-services', 'Relation\RelationController@getDoctorServices');
Route::get('service-doctors', 'Relation\RelationController@getServiceDoctors');

Route::get('doctors/services/{doctor_id}', 'Relation\RelationController@getDoctorServicesById')->name('doctors.services');

Route::post('saveServices-to-doctor', 'Relation\RelationController@saveServicesToDoctors')->name('save.doctors.services');


####################### has one through ##########################

Route::get('has-one-through', 'Relation\RelationController@getPatientDoctor');

Route::get('has-one-through-hanout', 'Relation\RelationController@getPatientDoctorLhanout');
Route::get('has-one-through-country', 'Relation\RelationController@getDoctorCountry');
Route::get('has-one-country', 'Relation\RelationController@getCountryDoctors');
Route::get('has-one', 'Relation\RelationController@getCountryHospital');
