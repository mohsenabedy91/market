<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class SellerController extends Controller
{
    #[
        OA\Get(
            path: "/seller",
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
            path: "/seller",
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
            path: "/seller/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            parameters: [
                new OA\Parameter(
                    name: "id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(
                        type: "integer"
                    ),
                    example: 1,
                )
            ],
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
            path: "/seller/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            parameters: [
                new OA\Parameter(
                    name: "id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(
                        type: "integer"
                    ),
                    example: 1,
                )
            ],
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
            path: "/seller/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: [""],
            parameters: [
                new OA\Parameter(
                    name: "id",
                    in: "path",
                    required: true,
                    schema: new OA\Schema(
                        type: "integer"
                    ),
                    example: 1,
                )
            ],
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
