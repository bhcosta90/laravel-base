export default (initialData = {}) => ({
    tags: Array.isArray(initialData) ? initialData : [],
    hasWireModel: false,
    modelValue: null,
    init() {
        if (this.$el.querySelector('input').hasAttribute('wire:model')) {
            this.hasWireModel = true;
            this.modelValue = this.$el.querySelector('input').getAttribute('wire:model');
        }
    },
    addTag(event) {
        const newTag = event.target.value.trim();
        if (newTag && !this.tags.includes(newTag)) {
            this.tags.push(newTag);
            if (this.hasWireModel) {
                this.$wire.set(this.modelValue, this.tags);
            }
            this.sendEvent();
        }
        event.target.value = '';
    },
    removeTag(index) {
        this.tags.splice(index, 1);
        if (this.hasWireModel) {
            this.$wire.set(this.modelValue, this.tags);
        }
        this.sendEvent();
    },
    addTagFromButton() {
        const tagValue = this.$refs.tagInput.value.trim();
        if (tagValue && !this.tags.includes(tagValue)) {
            this.tags.push(tagValue);
            this.sendEvent();
        }
        this.$refs.tagInput.value = ''; // Limpa o input
    },
    sendEvent() {
        this.$dispatch('tag-search', {'tags': this.tags});
    }
})
