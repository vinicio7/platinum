<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CountryController;
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
//Banks
Route::post('banks/create',             [BankController::class, 'create'])->name('banks.create');
Route::post('banks/edit',               [BankController::class, 'edit'])->name('banks.edit');
Route::get('banks/show',                [BankController::class, 'show'])->name('banks.show');
Route::post('banks/showid',             [BankController::class, 'showId'])->name('banks.showid');
Route::post('banks/delete',             [BankController::class, 'destroy'])->name('banks.destroy');

//Region
Route::post('region/create',            [RegionController::class, 'create'])->name('region.create');
Route::post('region/edit',              [RegionController::class, 'edit'])->name('region.edit');
Route::get('region/show',               [RegionController::class, 'show'])->name('region.show');
Route::post('region/showid',            [RegionController::class, 'showId'])->name('region.showid');
Route::post('region/delete',            [RegionController::class, 'destroy'])->name('region.delete');

//Countries
Route::post('country/create',         [CountryController::class, 'create'])->name('country.create');
Route::post('country/edit',           [CountryController::class, 'edit'])->name('country.edit');
Route::get('countries/show',          [CountryController::class, 'showAll'])->name('countries.show');
Route::post('country/showid',         [CountryController::class, 'showId'])->name('country.showid');
Route::post('country/delete',         [CountryController::class, 'destroy'])->name('country.destroy');


//Departaments
Route::post('departament/create',     [DepartamentController::class, 'create'])->name('departament.create');
Route::post('departament/edit',       [DepartamentController::class, 'edit'])->name('departament.edit');
Route::get('departaments/show',       [DepartamentController::class, 'showAll'])->name('departaments.show');
Route::post('departament/showid',     [DepartamentController::class, 'showId'])->name('departament.showid');
Route::post('departament/delete',     [DepartamentController::class, 'destroy'])->name('departament.destroy');

//Municipalities
Route::post('municipality/create',     [MunicipalityController::class, 'create'])->name('municipality.create');
Route::post('municipality/edit',       [MunicipalityController::class, 'edit'])->name('municipality.edit');
Route::get('municipalities/show',      [MunicipalityController::class, 'showAll'])->name('municipalities.show');
Route::post('municipality/showid',     [MunicipalityController::class, 'showId'])->name('municipality.showid');
Route::post('municipality/delete',     [MunicipalityController::class, 'destroy'])->name('municipality.destroy');

//Municipalities
Route::post('zone/create',     [ZoneController::class, 'create'])->name('zone.create');
Route::post('zone/edit',       [ZoneController::class, 'edit'])->name('zone.edit');
Route::get('zones/show',       [ZoneController::class, 'showAll'])->name('zones.show');
Route::post('zone/showid',     [ZoneController::class, 'showId'])->name('zone.showid');
Route::post('zone/delete',     [ZoneController::class, 'destroy'])->name('zone.destroy');