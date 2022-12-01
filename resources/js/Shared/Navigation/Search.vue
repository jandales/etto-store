<template>
<TransitionRoot as="template" :show="show">
    <TransitionChild  as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="-translate-y-24" enter-to="translate-y-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-y-full" leave-to="-translate-y-24">
        <div :class="['absolute top-0 left-0 bg-white h-24 w-full flex items-center px-8']">
            <MagnifyingGlassIcon class="h-8 w-8 text-gray-400 mr-4"></MagnifyingGlassIcon>

            <input type="text"
                v-model="keyword"
                @keydown.enter="handleSubmit"                
                class="flex-1 border-0 outline-none focus:outline-none focus:ring-0"
                placeholder="Search"
            >
            <XMarkIcon @click="$emit('close')" class="h-8 w-8 text-gray-400 ml-4"></XMarkIcon>
        </div>
    </TransitionChild>
</TransitionRoot>
    
</template>

<script setup>
import { ref } from 'vue';
import {  TransitionChild, TransitionRoot } from '@headlessui/vue'
import { MagnifyingGlassIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Inertia } from '@inertiajs/inertia';

defineEmits(['close'])

defineProps({
    show: {
        type: Boolean,
        default: false,
    }
})

const keyword = ref();

const handleSubmit = () => {
    Inertia.get(`/search?keyword=${keyword.value}`)
}

</script>