<?php

namespace Modules\Authorization\Http\Controllers\V1\Permissions;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Authorization\Http\Requests\V1\Permissions;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class PermissionController extends Controller
{
    #[
        OA\Get(
            path: "/api/v1/admin/permissions",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Permission"],
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
            path: "/api/v1/admin/permissions",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Permission"],
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
    public function store(Permissions\CreatePermissionRequest $request): Response
    {
        //
    }

    #[
        OA\Get(
            path: "/api/v1/admin/permissions/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Permission"],
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
            path: "/api/v1/admin/permissions/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Permission"],
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
    public function update(Permissions\UpdatePermissionRequest $request, int $id): Response
    {
        //
    }

    #[
        OA\Delete(
            path: "/api/v1/admin/permissions/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Permission"],
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
