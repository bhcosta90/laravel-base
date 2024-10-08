export default (open) => ({
    open: open,
    component: null,
    action: null,
    init() {
        window.addEventListener('user::password::open', this.load)
        window.addEventListener('user::password::success', this.success)
    },
    closeModal() {
        this.open = false;
        this.$dispatch('user::password::close', { sideBar: '{{ $id }}' })
    },
    load(data) {
        this.component = data.detail.component
        this.action = data.detail.action
    },
    success() {
        if(this.component && this.action) {
            Livewire.find(this.component).call(this.action, this.component)
        }
    }
});
