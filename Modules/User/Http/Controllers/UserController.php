<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[
        OA\Get(
            path: "",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [],
        )
    ]
    public function index(): Response
    {
        //
    }

    #[
        OA\Get(
            path: "",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [],
        )
    ]
    public function store(Request $request): Response
    {
        //
    }

    #[
        OA\Get(
            path: "",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [],
        )
    ]
    public function show(int $id): Response
    {
        //
    }

    #[
        OA\Get(
            path: "",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [],
        )
    ]
    public function update(Request $request, int $id): Response
    {
        //
    }

    #[
        OA\Get(
            path: "",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [],
        )
    ]
    public function destroy(int $id): Response
    {
        //
    }
}
