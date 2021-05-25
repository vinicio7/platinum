<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\ZoneController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::post('login',                      'LoginController@login')->name('login');
    Route::post('logout',                     'LoginController@logout')->name('logout');

    Route::post('users/create',               'UserController@create');
    Route::post('users/edit',                 'UserController@edit')->name('users.edit');
    Route::get('users/show',                  'UserController@show')->name('users.show');
    Route::post('users/showid',               'UserController@showid')->name('users.showid');
    Route::post('users/delete',               'UserController@delete')->name('users.delete');

    Route::post('regions/create',              'RegionController@create');
    Route::post('regions/edit',                'RegionController@edit')->name('regions.edit');
    Route::get('regions/show',                 'RegionController@show')->name('regions.show');
    Route::post('regions/showid',              'RegionController@showid')->name('regions.showid');
    Route::post('regions/delete',              'RegionController@delete')->name('regions.delete');

    Route::post('banks/create',                 'BankController@create');
    Route::post('banks/edit',                   'BankController@edit')->name('banks.edit');
    Route::get('banks/show',                    'BankController@show')->name('banks.show');
    Route::post('banks/showid',                 'BankController@showid')->name('banks.showid');
    Route::post('banks/delete',                 'BankController@delete')->name('regions.delete');

    Route::get('roles',                        'RoleController@get')->name('roles');  
    Route::get('zones',                        'ZoneController@get')->name('zones');  
    Route::get('regions',                      'RegionController@get')->name('regions');    
    Route::get('propietarios',                 'UserController@get')->name('propietarios');    
    Route::get('countries',                    'CountryController@get')->name('countries');
    Route::get('departaments',                 'DepartamentController@get')->name('departaments');
    Route::get('municipalities',               'MunicipalityController@get')->name('municipalities');

    Route::post('departaments/create',          'DepartamentController@create');
    Route::post('departaments/edit',            'DepartamentController@edit')->name('departaments.edit');
    Route::get('departaments/show',             'DepartamentController@show')->name('departaments.show');
    Route::post('departaments/showid',          'DepartamentController@showid')->name('departaments.showid');
    Route::post('departaments/delete',          'DepartamentController@delete')->name('departaments.delete');

    Route::post('municipalities/create',        'MunicipalityController@create');
    Route::post('municipalities/edit',          'MunicipalityController@edit')->name('municipalities.edit');
    Route::get('municipalities/show',           'MunicipalityController@show')->name('municipalities.show');
    Route::post('municipalities/showid',        'MunicipalityController@showid')->name('municipalities.showid');
    Route::post('municipalities/delete',        'MunicipalityController@delete')->name('municipalities.delete');

    Route::post('zones/create',                 'ZoneController@create');
    Route::post('zones/edit',                   'ZoneController@edit')->name('zones.edit');
    Route::get('zones/show',                    'ZoneController@show')->name('zones.show');
    Route::post('zones/showid',                 'ZoneController@showid')->name('zones.showid');
    Route::post('zones/delete',                 'ZoneController@delete')->name('zones.delete');

    Route::post('rols/create',                 'RoleController@create');
    Route::post('rols/edit',                   'RoleController@edit')->name('rols.edit');
    Route::get('rols/show',                    'RoleController@show')->name('rols.show');
    Route::post('rols/showid',                 'RoleController@showid')->name('rols.showid');
    Route::post('rols/delete',                 'RoleController@delete')->name('rols.delete');

    Route::get('propierty/export',            'PropertyController@export');
    Route::post('propierty/create',            'PropertyController@create');
    Route::post('propierty/rent',              'PropertyController@rent');
    Route::post('propierty/sale',              'PropertyController@sale');
    Route::post('propierty/image',             'PropertyController@image');
    Route::post('propierty/edit',              'PropertyController@edit')->name('propierty.edit');
    Route::get('propierty/show',               'PropertyController@show')->name('propierty.show');
    Route::post('propierty/showid',            'PropertyController@showid')->name('propierty.showid');
    Route::post('propierty/delete',            'PropertyController@delete')->name('propierty.delete');