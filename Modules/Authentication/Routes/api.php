<?php

use Illuminate\Support\Facades\Route;
use Modules\Authentication\Http\Controllers\V1\AuthController;

Route::prefix("v1/auth")->name("auth.")->group(function () {
    Route::post("register", [AuthController::class, "register"])->name("register");
    Route::post("login", [AuthController::class, "login"])->name("login");

    Route::middleware("auth:api")->group(function () {
        Route::post("logout", [AuthController::class, "logout"])->name("logout");
    });
});
