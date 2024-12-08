<?php

declare(strict_types = 1);

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\{Auth, Session};

class LogoutAction
{
    public function handle(?string $guard = null): Redirector | RedirectResponse
    {
        Auth::guard($guard)->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect(route('login'));
    }
}
