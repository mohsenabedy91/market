<?php

use Illuminate\Support\Facades\Route;
use Modules\Authorization\Http\Controllers\V1;

Route::prefix("v1/admin")->name("v1.admin.")
    ->middleware(["auth:api", "role:admin,developer"])->group(function () {

        Route::prefix("roles")->name("roles.")->group(function () {
            Route::get("/", [V1\Roles\RoleController::class, "index"])->name("index");
            Route::post("", [V1\Roles\RoleController::class, "store"])->name("store");
            Route::get("{id}", [V1\Roles\RoleController::class, "show"])->name("show");
            Route::put("{id}", [V1\Roles\RoleController::class, "update"])->name("update")->middleware("can:update role");
            Route::delete("{id}", [V1\Roles\RoleController::class, "destroy"])->name("destroy")->middleware("can:delete role");
        });

        Route::prefix("permissions")->name("permissions.")->group(function () {
            Route::get("/", [V1\Permissions\PermissionController::class, "index"])->name("index");
            Route::post("", [V1\Permissions\PermissionController::class, "store"])->name("store");
            Route::get("{id}", [V1\Permissions\PermissionController::class, "show"])->name("show");
            Route::put("{id}", [V1\Permissions\PermissionController::class, "update"])->name("update")->middleware("can:update permission");
            Route::delete("{id}", [V1\Permissions\PermissionController::class, "destroy"])->name("destroy")->middleware("can:delete permission");
        });
    });
