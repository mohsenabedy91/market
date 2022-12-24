<?php

namespace Modules\Authentication\Http\Controllers\V1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Modules\Authentication\Http\Requests\V1\LoginRequest;
use Modules\Authentication\Http\Requests\V1\RegisterRequest;
use Modules\Authentication\Services\AuthService;
use Modules\Authentication\Transformers\V1\AuthResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @param AuthService $authService
     * @return AuthResource
     * @throws Exception
     */
    #[
        OA\Post(
            path: "/api/v1/auth/register",
            summary: "You can register with email and password a new user and get application access token for the current new user.",
            requestBody: new OA\RequestBody(
                content: new OA\JsonContent(
                    type: RegisterRequest::class
                ),
            ),
            tags: ["Authentication"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: "ok",
                    content: new OA\JsonContent(
                        type: AuthResource::class
                    ),
                ),
            ],
        )
    ]
    public function register(RegisterRequest $request, AuthService $authService): AuthResource
    {
        $user = $authService->register($request->validated());
        return new AuthResource($user);
    }

    /**
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return AuthResource
     * @throws Exception
     */
    #[
        OA\Post(
            path: "/api/v1/auth/login",
            summary: "You can login with email and password and get application access token for the current user.",
            requestBody: new OA\RequestBody(
                content: new OA\JsonContent(
                    type: LoginRequest::class
                ),
            ),
            tags: ["Authentication"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: "ok",
                    content: new OA\JsonContent(
                        type: AuthResource::class
                    ),
                ),
            ],
        )
    ]
    public function login(LoginRequest $request, AuthService $authService): AuthResource
    {
        $user = $authService->login($request->validated());
        return new AuthResource($user);
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[
        OA\Post(
            path: "/api/v1/auth/logout",
            summary: "You can log out from your account for the current user.",
            security: [["bearerAuth" => []]],
            tags: ["Authentication"],
            responses: [
                new OA\Response(
                    response: ResponseStatus::HTTP_OK,
                    description: "ok",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "status",
                                type: "boolean",
                                example: true,
                            ),
                            new OA\Property(
                                property: "message",
                                type: "string",
                                example: "You have been logged out.",
                            ),
                        ],
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
    public function logout(Request $request): Response
    {
        $token = $request->user()->token();
        $token->revoke();
        return response([
            "status" => true,
            "message" => Lang::get("authentication::messages.logged_out"),
        ]);
    }
}
