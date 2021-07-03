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
Route::any('propierty/pdf_total/{usuario_id}',          'PropertyController@pdf_total');
Route::any('propierty/limpiar/{usuario_id}',            'PropertyController@limpiar');
Route::any('remove/pdf',                               'PropertyController@remove_pdf');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::any('login',                      'LoginController@login')->name('login');
    Route::any('logout',                     'LoginController@logout')->name('logout');

    Route::any('users/create',               'UserController@create');
    Route::any('users/edit',                 'UserController@edit')->name('users.edit');
    Route::any('users/show',                  'UserController@show')->name('users.show');
    Route::any('users/showid',               'UserController@showid')->name('users.showid');
    Route::any('users/delete',               'UserController@delete')->name('users.delete');

    Route::any('regions/create',              'RegionController@create');
    Route::any('regions/edit',                'RegionController@edit')->name('regions.edit');
    Route::any('regions/show',                 'RegionController@show')->name('regions.show');
    Route::any('regions/showid',              'RegionController@showid')->name('regions.showid');
    Route::any('regions/delete',              'RegionController@delete')->name('regions.delete');

    Route::any('banks/create',                 'BankController@create');
    Route::any('banks/edit',                   'BankController@edit')->name('banks.edit');
    Route::any('banks/show',                    'BankController@show')->name('banks.show');
    Route::any('banks/showid',                 'BankController@showid')->name('banks.showid');
    Route::any('banks/delete',                 'BankController@delete')->name('regions.delete');

    Route::any('roles',                        'RoleController@get')->name('roles');  
    Route::any('zones',                        'ZoneController@get')->name('zones');  
    Route::any('regions',                      'RegionController@get')->name('regions');    
    Route::any('propietarios',                 'UserController@get')->name('propietarios');    
    Route::any('countries',                    'CountryController@get')->name('countries');
    Route::any('departaments',                 'DepartamentController@get')->name('departaments');
    Route::any('municipalities',               'MunicipalityController@get')->name('municipalities');

    Route::any('departaments/create',          'DepartamentController@create');
    Route::any('departaments/edit',            'DepartamentController@edit')->name('departaments.edit');
    Route::any('departaments/show',             'DepartamentController@show')->name('departaments.show');
    Route::any('departaments/showid',          'DepartamentController@showid')->name('departaments.showid');
    Route::any('departaments/delete',          'DepartamentController@delete')->name('departaments.delete');

    Route::any('municipalities/create',        'MunicipalityController@create');
    Route::any('municipalities/edit',          'MunicipalityController@edit')->name('municipalities.edit');
    Route::any('municipalities/show',           'MunicipalityController@show')->name('municipalities.show');
    Route::any('municipalities/showid',        'MunicipalityController@showid')->name('municipalities.showid');
    Route::any('municipalities/delete',        'MunicipalityController@delete')->name('municipalities.delete');

    Route::any('zones/create',                 'ZoneController@create');
    Route::any('zones/edit',                   'ZoneController@edit')->name('zones.edit');
    Route::any('zones/show',                    'ZoneController@show')->name('zones.show');
    Route::any('zones/showid',                 'ZoneController@showid')->name('zones.showid');
    Route::any('zones/delete',                 'ZoneController@delete')->name('zones.delete');

    Route::any('rols/create',                 'RoleController@create');
    Route::any('rols/edit',                   'RoleController@edit')->name('rols.edit');
    Route::any('rols/show',                    'RoleController@show')->name('rols.show');
    Route::any('rols/showid',                 'RoleController@showid')->name('rols.showid');
    Route::any('rols/delete',                 'RoleController@delete')->name('rols.delete');

    
    Route::any('propierty/export',             'PropertyController@export');
    Route::any('propierty/create',            'PropertyController@create');
    Route::any('propierty/rent',              'PropertyController@rent');
    Route::any('propierty/sale',              'PropertyController@sale');
    Route::any('propierty/image',             'PropertyController@image');
    Route::any('propierty/edit',              'PropertyController@edit')->name('propierty.edit');
    Route::any('propierty/show',               'PropertyController@show')->name('propierty.show');
    Route::any('propierty/showlist',           'PropertyController@show_list')->name('propierty.show_list');
    Route::any('propierty/showid',            'PropertyController@showid')->name('propierty.showid');
    Route::any('propierty/delete',            'PropertyController@delete')->name('propierty.delete');
    Route::any('propierty/add_pdf',           'PropertyController@add_pdf')->name('propierty.add_pdf');
