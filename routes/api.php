<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;




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

Route::middleware(['api_token'])->group(function () {
    //Banks
    Route::post('banks/create',             'BanksController@create')->name('banks.create');
    Route::post('banks/edit',               'BanksController@edit')->name('banks.edit');
    Route::get('banks/show',                'BanksController@show')->name('banks.show');
    Route::post('banks/showid',             'BanksController@showid')->name('banks.showid');
    Route::post('banks/delete',             'BanksController@delete')->name('banks.destroy');

    //Region
    Route::post('region/create',            'BanksController@create')->name('region.create')->middleware('api_token');
    Route::post('region/edit',              'BanksController@edit')->name('region.edit');
    Route::get('region/show',               'BanksController@show')->name('region.show');
    Route::post('region/showid',            'BanksController@showid')->name('region.showid');
    Route::post('region/delete',            'BanksController@delete')->name('region.delete');

    //User
    Route::post('user/create',              'UserController@create')->name('user.create');
    Route::post('user/edit',                'UserController@edit')->name('user.edit');
    Route::get('user/show',                 'UserController@show')->name('user.show');
    Route::post('user/showid',              'UserController@showid')->name('user.showid');

});










