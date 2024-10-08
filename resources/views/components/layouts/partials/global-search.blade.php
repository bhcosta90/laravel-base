<div
    class="relative flex flex-1"
    x-data="tagsComponent({{ json_encode(request()->get('search'))}})"
>
    <svg class="pointer-events-none absolute  inset-y-0 left-0 h-full w-5 text-gray-400"
         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd"
              d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
              clip-rule="evenodd"/>
    </svg>
    <div class="join w-full h-full ml-[2rem]">
        <div class="join-item flex-grow h-full">
            <div class="w-full h-full">
                <div class="h-full bg-white flex items-center flex-wrap gap-2 rounded w-full
                    focus-within:border-blue-500">
                    <template x-for="(tag, index) in tags" :key="index">
                        <span class="bg-blue-200 text-blue-800 rounded-lg px-2 py-1 inline-flex items-center">
                            <span x-text="tag"></span>
                            <button @click="removeTag(index)" class="ml-1 text-red-600">x</button>
                        </span>
                    </template>

                    <input
                        x-ref="tagInput"
                        type="text"
                        placeholder="Add a search"
                        @keydown.enter.prevent="addTag($event)"
                        class="flex-1 h-full w-full border-none focus:outline-none p- border-l-0"
                        :value="hasWireModel ? $wire.entangle(modelValue) : ''"
                    />
                </div>
            </div>
        </div>
        <x-ui.button button primary label="Search" class="h-full" join @click.prevent="addTagFromButton" />
    </div>

</div>
