<template>
    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
        <slot></slot>
    </a>
</template>
<script setup>
defineProps({
    active: null,
    name: {
        required: true,
        type: String,

    }
})
</script>