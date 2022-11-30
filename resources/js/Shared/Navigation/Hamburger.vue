<template>
    <button type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden" @click="$emit('open')">
        <span class="sr-only">Open menu</span>
        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
    </button>
</template>

<script setup>
import { Bars3Icon } from '@heroicons/vue/24/outline'
const emits = defineEmits(['open']);
</script>
