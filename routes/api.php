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
