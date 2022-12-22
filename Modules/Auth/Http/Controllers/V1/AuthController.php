<?php

namespace Modules\Auth\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\V1\RegisterRequest;
use Modules\Auth\Services\AuthService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class AuthController extends Controller
{
    #[
        OA\Post(
            path: "/api/v1/auth/register",
            summary: "You can register with email and password a new user and get application access token for the current new user.",
            requestBody: new OA\RequestBody(
                content: new OA\JsonContent(
                    type: RegisterRequest::class
                ),
            ),
            tags: ["Auth"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: 'successful operation'
                ),
            ],
        )
    ]
    public function register(RegisterRequest $request, AuthService $authService): Response
    {
        $authService->register($request->validated());
    }

    #[
        OA\Post(
            path: "/api/v1/auth/login",
            summary: "You can login with email and password and get application access token for the current user.",
            tags: ["Auth"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: 'successful operation'
                ),
            ],
        )
    ]
    public function login(Request $request): Response
    {
        //
    }

    #[
        OA\Post(
            path: "/api/v1/auth/logout",
            summary: "You can log out from your account for the current user.",
            security: [["bearerAuth" => []]],
            tags: ["Auth"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: 'successful operation'
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
    public function logout(Request $request): Response
    {
        //
    }
}
