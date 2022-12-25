<?php

namespace Modules\Authorization\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param mixed ...$roles
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, ...$roles): mixed
    {
        if (!$request->user() || !$request->user()->hasRoles($roles)) {
            throw new AuthorizationException(
                Lang::get("authorization::messages.unauthorized"),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
