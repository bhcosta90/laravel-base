<?php

declare(strict_types = 1);

namespace App\Dev\Livewire;

use App\Livewire\Traits\HandleRedirect;
use App\Models\User;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Livewire\Attributes\{Computed, On};
use Livewire\Component;

class Login extends Component
{
    use HandleRedirect;

    public ?int $user = null;

    public function mount(): void
    {
        if (app()->isProduction()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->user = auth()->id();
    }

    public function render(): View
    {
        return view('dev.livewire.login');
    }

    #[Computed]
    #[On('user::index')]
    public function users(): Builder
    {
        return User::query()->orderBy('created_at');
    }

    public function submit(): void
    {
        $this->validate([
            'user' => ['nullable', Rule::exists('users', 'id')],
        ]);

        if (filled($this->user)) {
            Auth::loginUsingId($this->user);
            $this->redirectRouteMessage('dashboard', 'You have successfully logged in.');

            return;
        }

        Auth::logout();
        $this->redirectRoute('login');
    }
}
