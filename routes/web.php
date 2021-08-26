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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get');
header("Access-Control-Max-Age", "3600");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Access-Control-Allow-Credentials", "true");

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
Route::get('/propierty/admin/{id}',		'PropertyController@ver_admin');
Route::get('/galeria/{id}',				'PropertyController@galeria');
Route::get('departaments',              'DepartamentController@index')->name('departaments');
Route::get('municipalities',            'MunicipalityController@index')->name('municipalities');
Route::get('zones',            			'ZoneController@index')->name('zones');
Route::get('capsulas',            		'ZoneController@capsulas')->name('capsulas');
Route::get('rols',            			'RoleController@index')->name('rols');
Route::get('propierties',            	'PropertyController@index')->name('propierties');
Route::get('pdf_list',            		'PropertyController@pdf_list')->name('pdf_list');
Route::get('propiedades',            	'PropertyController@propiedades')->name('propiedades');
Route::get('propiedades_test',          'PropertyController@propiedades_test')->name('propiedades_test');
Route::get('propiedades_agente/{agente}','PropertyController@propiedades_agente')->name('propiedades_agente');
Route::post('send_message',            	'UserController@send_message')->name('send_message');
Route::post('capsulas',      			'UserController@capsulas')->name('capsulas');
Route::get('/pdf/{id}',                	'PropertyController@pdf');
Route::get('/tour/{id}',                'PropertyController@tour');