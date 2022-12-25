<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:api")->get("/seller", function (Request $request) {
    return $request->user();
});
