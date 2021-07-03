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
Route::get('propiedades_post',            	'PropertyController@propiedades_post')->name('propiedades_post');
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
Route::post('login', 	 		 		'AdminController@login_post')->name('login');
Route::get('dashboard', 	 	 		'AdminController@dashboard')->name('dashboard');
Route::get('home', 	 			 		'AdminController@home')->name('home');
Route::get('users',                     'UserController@index')->name('users');
Route::get('regions',                   'RegionController@index')->name('regions');
Route::get('banks',                     'BankController@index')->name('banks');

Route::get('asociate/detail/{id}',		'UserController@asociate');
Route::get('/propierty/view/{id}',		'PropertyController@ver_propiedad');
Route::get('/galeria/{id}',				'PropertyController@galeria');
Route::get('departaments',              'DepartamentController@index')->name('departaments');
Route::get('municipalities',            'MunicipalityController@index')->name('municipalities');
Route::get('zones',            			'ZoneController@index')->name('zones');
Route::get('rols',            			'RoleController@index')->name('rols');
Route::get('propierties',            	'PropertyController@index')->name('propierties');
Route::get('pdf_list',            		'PropertyController@pdf_list')->name('pdf_list');
Route::get('propiedades',            	'PropertyController@propiedades')->name('propiedades');


Route::get('/pdf/{id}',                	'PropertyController@pdf');