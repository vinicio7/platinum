<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RegionController;
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

    Route::post('login',                'LoginController@login')->name('login');
    Route::post('logout',               'LoginController@logout')->name('logout');

    Route::post('banks',                    'BankController@index')->name('banks');
    Route::post('banks/create',             'BankController@create')->name('banks.create');
    Route::post('banks/edit',               'BankController@edit')->name('banks.edit');
    Route::get('banks/show',                'BankController@show')->name('banks.show');
    Route::post('banks/showid',             'BankController@showid')->name('banks.showid');
    Route::post('banks/delete',             'BankController@delete')->name('banks.destroy');

    Route::post('regions',                   'RegionController@index')->name('regions');
    Route::post('regions/create',            'RegionController@create')->name('regions.create');
    Route::post('regions/edit',              'RegionController@edit')->name('regions.edit');
    Route::get('regions/show',               'RegionController@show')->name('regions.show');
    Route::post('regions/showid',            'RegionController@showid')->name('regions.showid');
    Route::post('regions/delete',            'RegionController@delete')->name('regions.delete');

    Route::post('zones',                      'ZoneController@index')->name('zones');
    Route::post('zones/create',               'ZoneController@create')->name('zones.create');
    Route::post('zones/edit',                 'ZoneController@edit')->name('zones.edit');
    Route::get('zones/show',                  'ZoneController@show')->name('zones.show');
    Route::post('zones/showid',               'ZoneController@showid')->name('zones.showid');
    Route::post('zones/delete',               'ZoneController@delete')->name('zones.destroy');

    Route::get('roles',                       'RoleController@get')->name('roles');
    Route::post('roles',                      'RoleController@index')->name('roles');
    Route::post('roles/create',               'RoleController@create')->name('roles.create');
    Route::post('roles/edit',                 'RoleController@edit')->name('roles.edit');
    Route::get('roles/show',                  'RoleController@show')->name('roles.show');
    Route::post('roles/showid',               'RoleController@showid')->name('roles.showid');
    Route::post('roles/delete',               'RoleController@delete')->name('zones.destroy');

    Route::post('users/create',              'UserController@create');
    Route::post('users/edit',                'UserController@edit')->name('users.edit');
    Route::get('users/show',                 'UserController@show')->name('users.show');
    Route::post('users/showid',              'UserController@showid')->name('users.showid');
    Route::post('users/delete',              'UserController@delete')->name('users.delete');
    /*
    //User
   

    //Countries
    Route::post('country/create',         'CountryController@create')->name('country.create');
    Route::post('country/edit',           'CountryController@edit')->name('country.edit');
    Route::get('countries/show',          'CountryController@show')->name('countries.show');
    Route::post('country/showid',         'CountryController@showid')->name('country.showid');
    Route::post('country/delete',         'CountryController@delete')->name('country.delete');

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
    */
