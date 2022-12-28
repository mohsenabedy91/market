<?php

namespace Modules\User\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class UserController extends Controller
{
    #[
        OA\Get(
            path: "/user",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_UNAUTHORIZED,
                    description: "Unauthorized",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: false,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You are not authenticated.",
                            ),
                        ],
                    ),
                ),
            ],
        )
    ]
    public function index(): Response
    {
        //
    }

    #[
        OA\Post(
            path: "/user",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_UNAUTHORIZED,
                    description: "Unauthorized",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: false,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You are not authenticated.",
                            ),
                        ],
                    ),
                ),
            ],
        )
    ]
    public function store(Request $request): Response
    {
        //
    }

    #[
        OA\Get(
            path: "/user/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_UNAUTHORIZED,
                    description: "Unauthorized",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: false,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You are not authenticated.",
                            ),
                        ],
                    ),
                ),
            ],
        )
    ]
    public function show(int $id): Response
    {
        //
    }

    #[
        OA\Put(
            path: "/user/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_UNAUTHORIZED,
                    description: "Unauthorized",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: false,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You are not authenticated.",
                            ),
                        ],
                    ),
                ),
            ],
        )
    ]
    public function update(Request $request, int $id): Response
    {
        //
    }

    #[
        OA\Delete(
            path: "/user/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_UNAUTHORIZED,
                    description: "Unauthorized",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: false,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You are not authenticated.",
                            ),
                        ],
                    ),
                ),
            ],
        )
    ]
    public function destroy(int $id): Response
    {
        //
    }
}
