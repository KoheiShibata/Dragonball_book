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
Route::post("/season_create", [App\Http\Controllers\SeasonController::class, "create"]);
Route::post("/season_edit", [App\Http\Controllers\SeasonController::class, "edit"]);
Route::get("/season_delete/{id}", [App\Http\Controllers\SeasonController::class, "delete"]);

Route::get("/tribes", [App\Http\Controllers\TribeController::class, "tribes"]);
Route::post("/tribe_create", [App\Http\Controllers\TribeController::class, "create"]);
Route::post("/tribe_edit", [App\Http\Controllers\TribeController::class, "edit"]);
Route::get("/tribe_delete/{id}", [App\Http\Controllers\TribeController::class, "delete"]);

Route::get("/character_create",[App\Http\Controllers\CharacterController::class, "character_create"]);
Route::post("/character_register",[App\Http\Controllers\CharacterController::class, "character_register"]);
Route::get("/character_list",[App\Http\Controllers\CharacterController::class, "character_list"]);
Route::get("/character_edit/{id}",[App\Http\Controllers\CharacterController::class, "edit"]);
Route::post("/character_update",[App\Http\Controllers\CharacterController::class, "update"]);
Route::get("/character_delete/{id}",[App\Http\Controllers\CharacterController::class, "delete"]);


Route::get("/dragonball_zukan",[App\Http\Controllers\ZukanController::class, "dragonball_zukan"]);
Route::get("/character_detail/{id}",[App\Http\Controllers\ZukanController::class, "character_detail"]);

// Route::get("/character_create", [App\Http\Controllers\CharacterController::class, "character_create"]);
// Route::post("/create", [App\Http\Controllers\CharacterController::class, "create"]);