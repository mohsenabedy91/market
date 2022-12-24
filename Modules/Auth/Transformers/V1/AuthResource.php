<?php

namespace Modules\Auth\Transformers\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[
    OA\Schema(
        title: "AuthResource",
        properties: [
            new OA\Property(
                property: "",
            ),
        ],
        type: "object",
    )
]
class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
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
            'status' => true,
        ];
    }
}
