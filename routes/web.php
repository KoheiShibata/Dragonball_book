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


Route::controller(TribeController::class)->prefix("tribe")->group(function(){
    Route::get("/", "tribeList");
    Route::post("/", "create");
    Route::put("/", "edit");
    Route::delete("/{id}", "delete");
});

Route::controller(SeasonController::class)->prefix("season")->group(function(){
    Route::get("/", "seasonList");
    Route::post("/", "create");
    Route::put("/", "edit");
    Route::delete("/{id}", "delete");
});



Route::get("/character_create",[App\Http\Controllers\CharacterController::class, "character_create"]);
Route::post("/character_register",[App\Http\Controllers\CharacterController::class, "character_register"]);
Route::get("/character_list",[App\Http\Controllers\CharacterController::class, "character_list"]);
Route::get("/character_edit/{id}",[App\Http\Controllers\CharacterController::class, "edit"]);
Route::post("/character_update",[App\Http\Controllers\CharacterController::class, "update"]);
Route::get("/character_delete/{id}",[App\Http\Controllers\CharacterController::class, "delete"]);


Route::get("/dragonball_zukan",[App\Http\Controllers\ZukanController::class, "dragonball_zukan"]);
Route::get("/character_detail/{id}",[App\Http\Controllers\ZukanController::class, "character_detail"]);