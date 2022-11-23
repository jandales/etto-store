<template>
    <div
        class="group relative flex items-center w-72 rounded-md border shadow-sm  focus:outline-none   hover:ring-2 hover:ring-indigo-600">
        <MagnifyingGlassIcon class="h-5 w-5 text-gray-600  ml-4" />
        <input ref="input" @input="updateInput" :value="modelValue" type="text"
            class="bg-transparent rounded-md px-2 w-full border-transparent  focus:border-transparent focus:ring-0"
            placeholder="Search...">
        <label :class="[showClearIcon ? '' : 'hidden', 'ml-auto  mr-2 cursor-pointer']">
            <XMarkIcon @click="handleClearInput" class="h-4 w-4" />
        </label>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline'
import { XMarkIcon } from '@heroicons/vue/20/solid';

const showClearIcon = ref(false);
const input = ref(null);

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: null,
    },
})

const emit = defineEmits(['update:modelValue'])

const updateInput = (event) => {

    const inputLength = event.target.value.length;

    showClearIcon.value = inputLength === 0 ? false : true;

    emit("update:modelValue", event.target.value);

}

const handleClearInput = () => {
    showClearIcon.value = false;
    input.value.value = null;
}


</script>