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

Route::get("/seasons", [App\Http\Controllers\SeasonController::class, "seasons"]);
Route::post("/season_create", [App\Http\Controllers\SeasonController::class, "season_create"]);
Route::post("/edit", [App\Http\Controllers\SeasonController::class, "edit"]);
Route::get("/delete/{id}", [App\Http\Controllers\SeasonController::class, "delete"]);



// Route::get("/character_create", [App\Http\Controllers\CharacterController::class, "character_create"]);
// Route::post("/create", [App\Http\Controllers\CharacterController::class, "create"]);