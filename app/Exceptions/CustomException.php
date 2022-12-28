<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\Exceptions\V1\UserAlreadyExistException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\GoneHttpException;
use Symfony\Component\HttpKernel\Exception\LengthRequiredHttpException;
use Symfony\Component\HttpKernel\Exception\LockedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Throwable;
use TypeError;

class CustomException extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if (
            $request->is("api/*") ||
            $request->expectsJson() ||
            $request->wantsJson()
        ) {
            if ($e instanceof UserAlreadyExistException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_BAD_REQUEST)
                );
            }

            if ($e instanceof AuthenticationException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNAUTHORIZED)
                );
            }

            if ($e instanceof ErrorException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => Lang::get("messages.error"),
                    ],
                    $this->getStatusCode($e, Response::HTTP_BAD_REQUEST)
                );
            }

            if ($e instanceof ValidationException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->validator->errors(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNPROCESSABLE_ENTITY)
                );
            }

            if ($e instanceof ThrottleRequestsException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_TOO_MANY_REQUESTS)
                );
            }

            if ($e instanceof ModelNotFoundException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_NOT_FOUND)
                );
            }

            if ($e instanceof QueryException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_BAD_REQUEST)
                );
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage() ?: Lang::get("messages.not_found"),
                    ],
                    $this->getStatusCode($e, Response::HTTP_NOT_FOUND)
                );
            }

            if ($e instanceof TooManyRequestsHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_TOO_MANY_REQUESTS)
                );
            }

            if ($e instanceof AccessDeniedHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_FORBIDDEN)
                );
            }

            if ($e instanceof BadRequestHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_BAD_REQUEST)
                );
            }

            if ($e instanceof ConflictHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_CONFLICT)
                );
            }

            if ($e instanceof GoneHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_GONE)
                );
            }

            if ($e instanceof LengthRequiredHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_LENGTH_REQUIRED)
                );
            }

            if ($e instanceof LockedHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_LOCKED)
                );
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_METHOD_NOT_ALLOWED)
                );
            }

            if ($e instanceof NotAcceptableHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_NOT_ACCEPTABLE)
                );
            }

            if ($e instanceof PostTooLargeException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_REQUEST_ENTITY_TOO_LARGE)
                );
            }

            if ($e instanceof PreconditionFailedHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ], $this->getStatusCode($e, Response::HTTP_PRECONDITION_FAILED)
                );
            }

            if ($e instanceof PreconditionRequiredHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_PRECONDITION_REQUIRED)
                );
            }

            if ($e instanceof ServiceUnavailableHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_SERVICE_UNAVAILABLE)
                );
            }

            if ($e instanceof UnauthorizedHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNAUTHORIZED)
                );
            }

            if ($e instanceof UnprocessableEntityHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNPROCESSABLE_ENTITY)
                );
            }

            if ($e instanceof UnsupportedMediaTypeHttpException) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_UNSUPPORTED_MEDIA_TYPE)
                );
            }

            if ($e instanceof Exception) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_BAD_REQUEST)
                );
            }

            if ($e instanceof TypeError) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => "[Check your database tables and connection] " . $e->getMessage(),
                    ],
                    $this->getStatusCode($e, Response::HTTP_INTERNAL_SERVER_ERROR)
                );
            }
        }

        return parent::render($request, $e);
    }

    private function getStatusCode($e, $statusCode): int
    {
        return $e->getCode() && $e->getCode() < 503 && $e->getCode() > 300
            ? $e->getCode()
            : $statusCode;
    }
}
