@props(['open' => false, 'title' => null, 'footer' => null, 'create' => null])

@php($id = filled($title) ? str($title)->kebab() : now() . '-side-bar')

<div x-data="{
        open: @entangle("open"),
        init() {
            this.$watch('open', (open) => open === false ? this.sideBarEvent() : this.focusInput())
        },
        close() {
            this.open = false;
        },
        sideBarEvent() {
            this.$dispatch('side-bar-closed', { sideBar: '{{ $id }}' })
        },
        focusInput() {
            this.$nextTick(() => {
                // const inputs = this.$refs.slot.querySelectorAll('input, select, textarea, button, a[href]')
                // inputs[0]?.focus();
            });
        }
}">
    @if(filled($create))
        <x-ui.button
            primary
            outline
            :label="$create"
            @click="$dispatch('load::manager')"
            wire:target="$dispatch('load::manager')"
        />
    @endif
    <div class="drawer drawer-end" style="z-index: 100">
        <input id="my-drawer-{{ $id }}" type="checkbox" class="drawer-toggle" x-model="open" />
        <div class="drawer-side">
            <div class="drawer-overlay" @click="close"></div>
            <div class="bg-base-200 text-base-content min-h-full w-[25rem] flex flex-col justify-between">
                <div>
                    <div class="px-5 pr-9">
                        <x-ui.slide.header :$title />
                    </div>

                    @if($open)
                        <div class="px-5 pr-9">{{ $slot }}</div>
                    @endif
                </div>

                @if(blank($footer))
                    <div class="border-t border-accent-content">
                        <div class="grid grid-cols-2 space-x-4 mt-4 px-5 pr-9 pb-5">
                            <div class="w-full">
                                <x-ui.button
                                    primary
                                    label="Save"
                                    wire:click="submit"
                                    wire:target="submit"
                                    full
                                />
                            </div>
                            <div class="w-full">
                                <x-ui.button
                                    neutral
                                    type="button"
                                    label="Cancel"
                                    @click="close"
                                    full
                                />
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
