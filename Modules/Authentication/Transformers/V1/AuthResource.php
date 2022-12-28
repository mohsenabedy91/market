<?php

namespace Modules\Authentication\Transformers\V1;

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
                property: "data",
                properties: [
                    new OA\Property(
                        property: "first_name",
                        type: "string",
                        example: "Mohsen",
                    ),
                    new OA\Property(
                        property: "last_name",
                        type: "string",
                        example: "Abedy",
                    ),
                    new OA\Property(
                        property: "email",
                        type: "email",
                        example: "mohsen.abedy@yahoo.com",
                    ),
                    new OA\Property(
                        property: "access_token",
                        type: "string",
                        example: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiOWVmMThkNjU5N2JmOGRjNjhlMThjZTcwYzRjYzQ1YmUwYTJjN2Y0ZDMzYjljOWRiNDlmYzdlMDMzMWQwZjhhY2VmMmUxMzE2NGRlY2E2MWUiLCJpYXQiOjE2NzE4NjE0NzYuNjc3NjkyLCJuYmYiOjE2NzE4NjE0NzYuNjc3Njk0LCJleHAiOjE3MDMzOTc0NzYuNjc2NTIyLCJzdWIiOiIxMyIsInNjb3BlcyI6W119.R81ZPtpwKHbt3sSaefrzoEFHLszWAz2GfNWSfBgOsj5SbojPQAm1dv2p45O4MeUBPwOAfB4W4HoTI72Ihr5_EU_RNzOn8VynJODXkD4J4Rolwqhceycs6OTG6DtpNi-OtUz-KIJFg-wslv_-i3MjtdL-1sfgerRMbow0zB_rd3_KRZBAvQ2vNce9QOdmvmlXh4HUDkWJpB4M1rp407C3q96QSl13Wu9pMt_r3N6YZZbmzOZ4TcnPxrT5w6mN5vIhUriGmLXz2fbH6IzomW9do45sYW5IEDkAPpZzgZE022wBlsv3hPXT6HTJsW8Krcye4FTLRcJPaCXvGDhfYd4Y3NU4j-SKm8YkTHH8K06CHslt_aTT5ZsGP5-nWFicOcJakwIN5oUokZl7Xi_20OsrS3OR_qX8oCjvM81jF8TNuslVJz4NJN4nH2uKUAvshYjWF9bI5YP_-3NBv4TzqtC-2ivabcR1ViDHAMgFPBAzF2UzbpJ1Ula_5E61-XCYBd8efBnS6N5vFsz1RSpr2p7qycjZ2nhcoF4UcfGHMM0Frnfli-kLoqAhbK0V9lpsLNaLNQhKl5_8cwW9uGpPVJsRt9PSnnB2SVxNK2RzY6zkg0toflrqO161Dtjt3hzNjHbb1Fmi1MkX5aJ7cs-SKuIfIId0Ld_4WGRsJNpZxNZ1oIs"
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
        return [
            "first_name" => $this["first_name"],
            "last_name" => $this["last_name"],
            "email" => $this["email"],
            "access_token" => $this["token"]
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
