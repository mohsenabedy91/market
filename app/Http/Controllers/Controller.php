<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

define("API_HOST", config('swagger.variables.host'));

#[
    OA\Info(version: '0.1', title: 'Marketplace'),
    OA\Server(
        url: API_HOST,
    ),
    OA\Schema(
        format: 'http'
    ),
    OA\SecurityScheme(
        securityScheme: 'bearerAuth',
        type: 'http',
        name: 'bearerAuth',
        in: 'header',
        bearerFormat: 'JWT',
        scheme: 'bearer',
    )
]
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
