<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\ZoneController;
use App\Models\User;

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
	$asociats = User::with('rol')->where('rol_id',2)->get();
    return view('welcome',['asociats' => $asociats]);
});

Route::get('logout', 	 		 		'AdminController@logout')->name('logout');
Route::get('login', 	 		 		'AdminController@login')->name('login');
Route::get('dashboard', 	 	 		'AdminController@dashboard')->name('dashboard');
Route::post('dashboard', 	 	 		'AdminController@dashboard')->name('dashboard');
Route::get('home', 	 			 		'AdminController@home')->name('home');


Route::get('propierties', 	 	 		'AdminController@propierties')->name('propierties');
Route::get('regions', 	 	 	 		'AdminController@regions')->name('regions');
Route::get('zones', 	 	 	 		'AdminController@zones')->name('zones');
Route::get('banks', 	 	 	 		'AdminController@banks')->name('banks');
Route::get('history', 	 	 	 		'AdminController@history')->name('history');
Route::get('roles', 	 	 	 		'AdminController@roles')->name('roles');
Route::get('users', 	 	 	 		'AdminController@users')->name('users');

//Banks
	Route::get('banks',                    'BankController@index')->name('banks');
    Route::post('banks/create',             'BankController@create')->name('banks.create');
    Route::post('banks/edit',               'BankController@edit')->name('banks.edit');
    Route::get('banks/show',                'BankController@show')->name('banks.show');
    Route::post('banks/showid',             'BankController@showid')->name('banks.showid');
    Route::post('banks/delete',             'BankController@delete')->name('banks.destroy');

//Region
Route::post('region/create',            'RegionController@create')->name('region.create')->middleware('api_token');
Route::post('region/edit',              'RegionController@edit')->name('region.edit');
Route::get('region/show',               'RegionController@show')->name('region.show');
Route::post('region/showid',            'RegionController@showid')->name('region.showid');
Route::post('region/delete',            'RegionController@delete')->name('region.delete');

//User
Route::post('user/create',              'UserController@create')->name('user.create');
Route::post('user/edit',                'UserController@edit')->name('user.edit');
Route::get('user/show',                 'UserController@show')->name('user.show');
Route::post('user/showid',              'UserController@showid')->name('user.showid');

//Countries
Route::post('country/create',         'CountryController@create')->name('country.create');
Route::post('country/edit',           'CountryController@edit')->name('country.edit');
Route::get('countries/show',          'CountryController@show')->name('countries.show');
Route::post('country/showid',         'CountryController@showid')->name('country.showid');
Route::post('country/delete',         'CountryController@delete')->name('country.destroy');

//Departaments
Route::post('departament/create',     'DepartamentController@create')->name('departament.create');
Route::post('departament/edit',       'DepartamentController@edit')->name('departament.edit');
Route::get('departaments/show',       'DepartamentController@show')->name('departaments.show');
Route::post('departament/showid',     'DepartamentController@showid')->name('departament.showid');
Route::post('departament/delete',     'DepartamentController@delete')->name('departament.destroy');

//Municipalities
Route::post('municipality/create',     'MunicipalityController@create')->name('municipality.create');
Route::post('municipality/edit',       'MunicipalityController@edit')->name('municipality.edit');
Route::get('municipalities/show',      'MunicipalityController@show')->name('municipalities.show');
Route::post('municipality/showid',     'MunicipalityController@showid')->name('municipality.showid');
Route::post('municipality/delete',     'MunicipalityController@delete')->name('municipality.destroy');

//Zones
Route::post('zone/create',     'ZoneController@create')->name('zone.create');
Route::post('zone/edit',       'ZoneController@edit')->name('zone.edit');
Route::get('zones/show',       'ZoneController@show')->name('zones.show');
Route::post('zone/showid',     'ZoneController@showid')->name('zone.showid');
Route::post('zone/delete',     'ZoneController@delete')->name('zone.destroy');
