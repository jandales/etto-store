<template>
    <div class="bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full" :class="{
        'bg-red-100 text-red-700': alert == 'error',
        'bg-blue-100 text-blue-700': alert == 'info',
        'bg-yellow-100 text-yellow-700': alert == 'info',
    }" role="alert">
        <CheckCircleIcon v-if="alert == 'success'" class="w-6 h-6 mr-2" />
        <XCircleIcon v-if="alert == 'error'" class="w-6 h-6 mr-2" />
        <ExclamationTriangleIcon v-if="alert == 'warning'" class="w-6 h-6 mr-2" />
        <InformationCircleIcon v-if="alert == 'info'" class="w-6 h-6 mr-2" />
        {{ message }}
        <XMarkIcon @click="close" class="ml-auto w-6 h-6 text-gray-500" />
    </div>
</template>

<script setup>

import { CheckCircleIcon, XMarkIcon, XCircleIcon, ExclamationTriangleIcon, InformationCircleIcon } from '@heroicons/vue/20/solid'
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

const emits = defineEmits(['close']);
const close = () => {
    emits('close')
}
</script>