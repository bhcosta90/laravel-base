<div x-data="tagsComponent()">
    <div class="border bg-white flex items-center flex-wrap gap-2 rounded w-full focus-within:border-blue-500">
        <template x-for="(tag, index) in tags" :key="index">
            <span class="bg-blue-200 text-blue-800 rounded-lg px-2 py-1 inline-flex items-center">
                <span x-text="tag"></span>
                <button @click="removeTag(index)" class="ml-1 text-red-600">x</button>
            </span>
        </template>

        <input
            x-ref="tagInput"
            type="text"
            placeholder="Add a tag"
            @keydown.enter.prevent="addTag($event)"
            class="flex-1 border-none focus:outline-none p-1"
            :value="hasWireModel ? $wire.entangle(modelValue) : ''"
        />
    </div>
</div>
