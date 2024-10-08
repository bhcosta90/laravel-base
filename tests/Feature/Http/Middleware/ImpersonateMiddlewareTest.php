<?php

declare(strict_types = 1);

use App\Http\Middleware\ImpersonateMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Session};

describe('Http/Middleware/ImpersonateMiddleware', function () {
    it('impersonates user when session has impersonate key', function () {
        $user = User::factory()->create();
        Session::put('impersonate', $user->id);

        $request    = Request::create('/some-route');
        $middleware = new ImpersonateMiddleware();

        $middleware->handle($request, function ($req) {
            return response('next middleware');
        });

        expect(Auth::check())->toBeTrue()
            ->and(Auth::id())->toBe($user->id);
    });

    it('does not impersonate user when session does not have impersonate key', function () {
        $request    = Request::create('/some-route');
        $middleware = new ImpersonateMiddleware();

        $middleware->handle($request, function () {
            return response('next middleware');
        });

        expect(Auth::check())->toBeFalse();
    });
});
