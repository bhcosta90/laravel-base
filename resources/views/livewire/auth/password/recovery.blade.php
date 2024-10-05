<section>
    <div class="w-full primary-gradient text-sm font-medium p-8 rounded space-y-2 md:space-y-4">
        <form id="form-login" class="space-y-2 md:space-y-4" wire:submit="submit">
            <h1 class="text-center font-semibold text-lg">
                @lang('Password recovery.')
            </h1>

            <x-ui.input email label="Email" id="login-email" wire:model="email" />
            <x-ui.button primary label="Recovery" full submit />
        </form>

        <x-auth.login.back message="You remember your password?" />
    </div>
</section>
