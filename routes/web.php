<?php

use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ZukanController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TribeController;
use App\Models\Character;
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


// Route::group(['middleware' => 'basicauth'], function () {
    // 一般利用者画面
    Route::get("/", [ZukanController::class, "home"])->name("home"); // ホーム画面
    
    Route::controller(ZukanController::class)->prefix("dragonball-pbook")->group(function () {
        Route::get("/", "index");
        Route::get("/filtering", "filtering");
        Route::get("/{id}", "detail"); 
    });

    Route::get("/dragonball-ranking", [RankingController::class, "index"])->name("ranking"); // ランキング画面
    
    Route::controller(LoginController::class)->prefix("login")->group(function () {
        Route::get("/", "loginForm")->name("login.index"); // ログイン画面
        Route::post("/", "loginJudge")->name("login.judge"); // ログイン判定
    }); 

    // 以下管理者のみ
    Route::middleware(['AdminAuth'])->group(function () {
        Route::controller(TribeController::class)->prefix("tribe")->group(function () {
            Route::get("/", "index");
            Route::post("/", "store");
            Route::put("/", "update");
            Route::delete("/{id}", "destory");
            Route::get("/{id}", "getControl");
        });
    
        Route::controller(SeasonController::class)->prefix("season")->group(function () {
            Route::get("/", "index");
            Route::post("/", "store");
            Route::put("/", "update");
            Route::delete("/{id}", "destory");
            Route::get("/{id}", "getControl");
        });
    
        Route::controller(CharacterController::class)->prefix("character")->group(function () {
            Route::get("/", "create");
            Route::post("/", "store");
            Route::get("/{id}", "edit");
            Route::put("/{id}", "update");
            Route::delete("/{id}", "destory");
        });
    
        Route::controller(CharacterController::class)->prefix("characters")->group(function () {
            Route::get("/", "index");
            Route::get("/filtering", "filtering");
        });

        Route::controller(LogoutController::class)->prefix("logout")->group(function () {
            Route::get("/", "getControl");
            Route::post("/", "logout")->name("logout"); // ログアウト処理
        });
    });
// });
