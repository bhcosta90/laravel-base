<div
    id="info-modal"
    x-data="{
        alerts: [],
        remove(key) {
            this.alerts = this.alerts.filter((alert) => alert.key !== key)
        },
        add(alert) {
            alert.key = Date.now()
            alert.is_confirmation = alert.type === 'confirmation'
            this.alerts.push(alert)
        },
        call(alert) {
            Livewire.find(alert.component).call(alert.action, alert.component, alert.params)

            this.remove(alert.key)
        }
    }"
    @alert.window="add($event.detail)"
    class="fixed inset-0 z-[75] flex flex-col items-end justify-center px-4 py-6 space-y-4 pointer-events-none sm:p-6 sm:justify-start"
    :class="alerts.length ? 'bg-black/50' : null"
>
    <template x-for="alert in alerts" :key="alert.key">
        <dialog x-bind:id="'info-modal-' + alert.key" class="modal" open>
            <div class="modal-box w-full max-w-xl rounded-md shadow-lg p-0 pointer-events-auto">
                <div class="flex p-6 gap-2">
                    <x-ui.icon name="warning" class="!size-16 text-secondary" x-show="alert.type !== 'confirmation'" />

                    <div class="flex flex-col gap-4 w-full">
                        <h3 x-show="alert.title" x-text="alert.title" class="text-xl font-bold text-primary-content-800"></h3>

                        <p class="text-base-450" x-show="alert.description" x-html="alert.description"></p>
                    </div>
                </div>

                <div class="flex bg-base-100 p-4 items-center justify-between gap-2">
                    <x-ui.button label="Close" secondary x-show="!alert.is_confirmation" x-on:click="remove(alert.key)" />
                    <x-ui.button
                        x-text="alert.textCancel"
                        secondary
                        x-show="alert.is_confirmation"
                        x-on:click="alert.confirm ? remove(alert.key) : call(alert)"
                    />
                    <x-ui.button
                        x-text="alert.textConfirm"
                        primary
                        x-show="alert.is_confirmation && alert.action"
                        x-on:click="alert.confirm && alert.action ? call(alert) : remove(alert.key)"
                    />
                </div>
            </div>
        </dialog>
    </template>

</div>
