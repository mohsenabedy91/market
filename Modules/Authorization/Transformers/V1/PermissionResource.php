<?php

namespace Modules\Authorization\Transformers\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Schema(
        title: "PermissionResource",
        properties: [
            new OA\Property(
                property: "data",
                properties: [
                    new OA\Property(
                        property: "id",
                        type: "integer",
                        example: 1,
                    ),
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "super admin",
                    ),
                    new OA\Property(
                        property: "created_by",
                    ),
                    new OA\Property(
                        property: "updated_by",
                    ),
                ],
            ),
            new OA\Property(
                property: "status",
                type: "boolean",
                example: true,
            ),
        ],
        type: "object",
    )
]
class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this["id"],
            "name" => $this["name"],
            "created_by" => new CreatedByResource($this["created_by"]),
            "updated_by" => new UpdatedByResource($this["updated_by"]),
        ];
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param $request
     * @return bool[]
     */
    public function with($request): array
    {
        return [
            "status" => true,
        ];
    }
}
