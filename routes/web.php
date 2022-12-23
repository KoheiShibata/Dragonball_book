<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ZukanController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TribeController;
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

Route::controller(SeasonController::class)->group(function(){
    Route::get("/seasons", "seasons");
    Route::post("/season_create", "create");
    Route::post("/season_edit/{id}", "edit");
    Route::get("/season_delete/{id}", "delete");
});

Route::controller(TribeController::class)->prefix("tribe")->group(function(){
    Route::get("/", "tribeList");
    Route::post("/", "create");
    Route::put("/",  "edit");
    Route::delete("/{id}", "delete");
});

Route::controller(CharacterController::class)->group(function(){
    Route::get("/character_create", "character_create");
    Route::post("/character_register", "character_register");
    Route::get("/character_list", "character_list");
    Route::get("/character_edit/{id}", "edit");
    Route::post("/character_update", "update");
    Route::get("/character_delete/{id}",  "delete" );
});


Route::controller(ZukanController::class)->group(function(){
    Route::get("/dragonball_zukan", "dragonball_zukan");
    Route::get("/character_detail/{id}", "character_detail");
});

// Route::get("/character_create", [App\Http\Controllers\CharacterController::class, "character_create"]);
// Route::post("/create", [App\Http\Controllers\CharacterController::class, "create"]);