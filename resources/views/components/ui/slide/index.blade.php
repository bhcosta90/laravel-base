@props(['open' => false, 'title' => null])

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
    <div class="drawer drawer-end" style="z-index: 100">
        <input id="my-drawer-{{ $id }}" type="checkbox" class="drawer-toggle" x-model="open" />
        <div class="drawer-side">
            <div class="drawer-overlay" @click="close"></div>
            <divl class="menu bg-base-200 text-base-content min-h-full w-[25rem] p-4">
                {{ __($title) }}
            </divl>
        </div>
    </div>
</div>
