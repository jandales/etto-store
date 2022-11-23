<template>
    <div class="absolute top-12 right-12 w-80 p-4 max-w-sm shadow-lg bg-white rounded border ">
        <div class="flex">
            <CheckCircleIcon class="h-6 w-6 text-green-500" />
            <label class="ml-4 text-gray-900">{{ message }}</label>
            <XMarkIcon class="ml-auto text-gray-500 h-6 w-6" />
        </div>
    </div>
</template>

<script setup>

import { CheckCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline'

defineProps({
    alert: {
        type: String,
        default: null,
    },
    message: {
        type: String,
        default: null
    }
})

</script>