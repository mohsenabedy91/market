<?php

namespace Modules\Authorization\Transformers\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Schema(
        title: "CreatedByResource",
        properties: [
            new OA\Property(
                property: "data",
                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Mohsen Abedy",
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
class CreatedByResource extends JsonResource
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
            "name" => $this["first_name"] . " " . $this["last_name"],
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
