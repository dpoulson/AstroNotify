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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user', 'UserController');
Route::resource('requirement', 'RequirementsController');
Route::resource('location', 'LocationsController');
Route::get('subcountries/get_by_country', 'RequirementsController@get_by_country')->name('subcountries.get_by_country');
Route::get('locations/get_by_subcountry', 'RequirementsController@get_by_subcountry')->name('locations.get_by_subcountry');