<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\{Request};

class EmailIsUnverifiedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail()) {
            return redirect()->to('/');
        }

        return $next($request);
    }
}
