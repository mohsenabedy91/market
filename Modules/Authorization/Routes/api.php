<?php

use Illuminate\Support\Facades\Route;
use Modules\Authorization\Http\Controllers\V1;

Route::prefix("v1/admin")->name("v1.admin.")
    ->middleware(["auth:api", "role:admin,developer"])->group(function () {

        Route::controller(V1\Roles\RoleController::class)
            ->prefix("roles")->name("roles.")->group(function () {

                Route::get("/", "index")->name("index");
                Route::post("", "store")->name("store");
                Route::get("{id}", "show")->name("show");
                Route::put("{id}", "update")->name("update")->middleware("can:update role");
                Route::delete("{id}", "destroy")->name("destroy")->middleware("can:delete role");
            });

        Route::controller(V1\Permissions\PermissionController::class)
            ->prefix("permissions")->name("permissions.")->group(function () {

                Route::get("/", "index")->name("index");
                Route::post("", "store")->name("store");
                Route::get("{id}", "show")->name("show");
                Route::put("{id}", "update")->name("update")->middleware("can:update permission");
                Route::delete("{id}", "destroy")->name("destroy")->middleware("can:delete permission");
            });
    });
