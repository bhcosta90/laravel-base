export default () => ({
    open: false,
    component: null,
    action: null,
    init() {
        window.addEventListener('modal::confirmation::open', this.load)
        this.$watch('open', value => {
            if (value) {
                this.$refs.dialog.showModal();
            }
        });
    },
    closeModal() {
        this.open = false;
    },
    load(data) {
        this.component = data.detail.component
        this.action = data.detail.action
        this.open = true;
        alert(this.open)
    },
    success() {
        if(this.component && this.action) {
            Livewire.find(this.component).call(this.action, this.component)
        }
    }
});
