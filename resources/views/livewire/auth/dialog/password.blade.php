<div x-data="modalConfirmationPassword($wire.entangle('open').live)">
    <dialog x-show="open" :open="open" class="modal">
        <div class="modal-box">
            <form wire:submit="submit">
                <x-ui.input type="password" required wire:model="password" label="Current password" />
                <div class="modal-action">
                    <div class="flex justify-between w-full">
                        <x-ui.button warning label="Send" />
                        <x-ui.button primary @click="closeModal" label="Close" />
                    </div>
                </div>
            </form>
        </div>
    </dialog>
</div>
