<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     * @throws AuthenticationException
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->isJson()) {
            return route('login');
        }

        throw new AuthenticationException(
            Lang::get("messages.unauthenticated")
        );
    }
}
