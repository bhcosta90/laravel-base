<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Livewire\Traits\HandleRedirect;
use App\Models\User;

use function auth;
use function event;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

use Livewire\Attributes\Layout;
use Livewire\Component;

use function view;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    use HandleRedirect;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function mount(): void
    {
        if (auth()->check()) {
            $this->redirectRoute('dashboard');
        }
    }

    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit(): void
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ]);

        event(new Registered($user));

        $this->redirectRouteMessage('login', 'Your account has been created.');
    }

    protected function rules(): array
    {
        return [
            'name'     => 'required|min:3|max:121',
            'email'    => ['required', 'email', 'min:3', 'max:121', Rule::unique('users', 'email')],
            'password' => 'required|min:8|max:30|confirmed',
        ];
    }
}
