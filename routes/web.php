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

Route::get('/quienes', function () {
    $asociats = User::with('rol')->where('rol_id',2)->get();
    return view('quienes',['asociats' => $asociats]);
});

Route::get('/contacto', function () {
    $asociats = User::with('rol')->where('rol_id',2)->get();
    return view('contacto',['asociats' => $asociats]);
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
Route::get('banks',                     'BankController@index')->name('banks');
Route::get('banks/create',              'BankController@create')->name('banks.create');
Route::post('banks/edit',               'BankController@edit')->name('banks.edit');
Route::get('banks/show',                'BankController@show')->name('banks.show');
Route::post('banks/showid',             'BankController@showid')->name('banks.showid');
Route::post('banks/delete',             'BankController@delete')->name('banks.destroy');

//Region
Route::get('regions',                    'RegionController@index')->name('regions');
Route::post('regions/create',            'RegionController@create')->name('regions.create');
Route::post('regions/edit',              'RegionController@edit')->name('regions.edit');
Route::get('regions/show',               'RegionController@show')->name('regions.show');
Route::post('regions/showid',            'RegionController@showid')->name('regions.showid');
Route::post('regions/delete',            'RegionController@delete')->name('regions.destroy');

Route::get('zones',                    	 'ZoneController@index')->name('zones');
Route::post('zones/create',     		 'ZoneController@create')->name('zones.create');
Route::post('zones/edit',       		 'ZoneController@edit')->name('zones.edit');
Route::get('zones/show',       			 'ZoneController@show')->name('zones.show');
Route::post('zones/showid',     		 'ZoneController@showid')->name('zones.showid');
Route::post('zones/delete',     		 'ZoneController@delete')->name('zones.destroy');

Route::get('users',                    	 'UserController@index')->name('users');
Route::post('users/create',              'UserController@create')->name('users.create');
Route::get('users/edit',                 'UserController@edit')->name('users.edit');
Route::get('users/show',                 'UserController@show')->name('users.show');
Route::post('users/showid',              'UserController@showid')->name('users.showid');
Route::get('users/delete',     		 	 'UserController@delete')->name('users.destroy');
/*
//Countries
Route::post('country/create',         	'CountryController@create')->name('country.create');
Route::post('country/edit',           	'CountryController@edit')->name('country.edit');
Route::get('countries/show',          	'CountryController@show')->name('countries.show');
Route::post('country/showid',         	'CountryController@showid')->name('country.showid');
Route::post('country/delete',         	'CountryController@delete')->name('country.destroy');

//Departaments
Route::post('departament/create',     	'DepartamentController@create')->name('departament.create');
Route::post('departament/edit',       	'DepartamentController@edit')->name('departament.edit');
Route::get('departaments/show',       	'DepartamentController@show')->name('departaments.show');
Route::post('departament/showid',     	'DepartamentController@showid')->name('departament.showid');
Route::post('departament/delete',     	'DepartamentController@delete')->name('departament.destroy');

//Municipalities
Route::post('municipality/create',      'MunicipalityController@create')->name('municipality.create');
Route::post('municipality/edit',        'MunicipalityController@edit')->name('municipality.edit');
Route::get('municipalities/show',       'MunicipalityController@show')->name('municipalities.show');
Route::post('municipality/showid',      'MunicipalityController@showid')->name('municipality.showid');
Route::post('municipality/delete',      'MunicipalityController@delete')->name('municipality.destroy');

//Zones

*/