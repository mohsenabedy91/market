<?php

namespace Modules\Authorization\Http\Controllers\V1\Roles;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Authorization\Http\Requests\V1\Roles;
use Modules\Authorization\Services\V1\Roles\RoleService;
use Modules\Authorization\Transformers\V1\RoleCollection;
use Modules\Authorization\Transformers\V1\RoleResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class RoleController extends Controller
{
    #[
        OA\Get(
            path: "/api/v1/admin/role",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Role"],
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
    public function index(RoleService $roleService): RoleCollection
    {
        $roles = $roleService->getRoles();
        return new RoleCollection($roles);
    }

    /**
     * @param Roles\CreateRoleRequest $request
     * @param RoleService $roleService
     * @return RoleResource
     */
    #[
        OA\Post(
            path: "/api/v1/admin/role",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Role"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_CREATED,
                    description: "Created",
                    content: new OA\JsonContent(
                        type: RoleResource::class
                    ),
                ),
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
    public function store(Roles\CreateRoleRequest $request, RoleService $roleService): RoleResource
    {
        $role = $roleService->storeRole($request->validated(), Auth::id());
        return new RoleResource($role);
    }

    #[
        OA\Get(
            path: "/api/v1/admin/roles/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Role"],
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
                    response: ResponseStatus::HTTP_OK,
                    description: "Ok",
                    content: new OA\JsonContent(
                        type: RoleResource::class
                    ),
                ),
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
    public function show(int $id, RoleService $roleService): RoleResource
    {
        $role = $roleService->getRoleById($id);
        return new RoleResource($role);
    }

    /**
     * @param Roles\UpdateRoleRequest $request
     * @param int $id
     * @param RoleService $roleService
     * @return RoleResource
     * @throws Exception
     */
    #[
        OA\Put(
            path: "/api/v1/admin/roles/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Role"],
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
                    response: ResponseStatus::HTTP_OK,
                    description: "Ok",
                    content: new OA\JsonContent(
                        type: RoleResource::class
                    ),
                ),
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
    public function update(Roles\UpdateRoleRequest $request, int $id, RoleService $roleService): RoleResource
    {
        $role = $roleService->updateRole($request->validated(), $id, Auth::id());
        return new RoleResource($role);
    }

    /**
     * @param int $id
     * @param RoleService $roleService
     * @return Response
     * @throws Exception
     */
    #[
        OA\Delete(
            path: "/api/v1/admin/roles/{id}",
            summary: "",
            security: [["bearerAuth" => []]],
            tags: ["Role"],
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
    public function destroy(int $id, RoleService $roleService): Response
    {
        $roleService->deleteById($id);
        return response(null, ResponseStatus::HTTP_NO_CONTENT);
    }
}
