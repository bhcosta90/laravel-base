<div>
    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    @if ($sent)
        <x-ui.alert success>
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </x-ui.alert>
    @endif

    <x-ui.button id="btn-resend-email" primary wire:click="resend">
        {{ __('Resend Verification Email') }}
    </x-ui.button>
</div>
