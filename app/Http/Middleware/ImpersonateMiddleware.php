<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ImpersonateMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($user = session('impersonate')) {
            auth()->onceUsingId($user);
        }

        return $next($request);
    }
}
