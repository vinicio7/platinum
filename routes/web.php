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

Route::get('logout', 	 		 'App\Http\Controllers\AdminController@logout')->name('logout');
Route::get('login', 	 		 'App\Http\Controllers\AdminController@login')->name('login');
Route::get('dashboard', 	 	 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');
Route::post('dashboard', 	 	 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');
Route::get('home', 	 			 'App\Http\Controllers\AdminController@home')->name('home');

Route::get('propierties', 	 	'App\Http\Controllers\AdminController@propierties')->name('propierties');
Route::get('regions', 	 	 	 'App\Http\Controllers\AdminController@regions')->name('regions');
Route::get('zones', 	 	 	 'App\Http\Controllers\AdminController@zones')->name('zones');
Route::get('banks', 	 	 	 'App\Http\Controllers\AdminController@banks')->name('banks');
Route::get('history', 	 	 	 'App\Http\Controllers\AdminController@history')->name('history');
Route::get('roles', 	 	 	 'App\Http\Controllers\AdminController@roles')->name('roles');
Route::get('users', 	 	 	 'App\Http\Controllers\AdminController@users')->name('users');
