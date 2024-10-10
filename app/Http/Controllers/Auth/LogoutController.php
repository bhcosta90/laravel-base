<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

use function redirect;

use Session;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
