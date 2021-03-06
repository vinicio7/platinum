<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;


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

Route::post('banks/create',         [BankController::class, 'create'])->name('banks.create');
Route::post('banks/edit',           [BankController::class, 'edit'])->name('banks.edit');
Route::get('banks/show',            [BankController::class, 'show'])->name('banks.show');
Route::post('banks/showid',         [BankController::class, 'showId'])->name('banks.showid');
Route::post('banks/delete',         [BankController::class, 'destroy'])->name('banks.destroy');

Route::post('country/create',         [CountryController::class, 'create'])->name('country.create');
Route::post('country/edit',           [CountryController::class, 'edit'])->name('country.edit');
Route::get('countries/show',          [CountryController::class, 'showAll'])->name('countries.show');
Route::post('country/showid',         [CountryController::class, 'showId'])->name('country.showid');
Route::post('country/delete',         [CountryController::class, 'destroy'])->name('country.destroy');


