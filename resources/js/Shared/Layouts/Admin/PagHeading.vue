<template>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">{{ title }}</h1>
        <div class=" ml-auto">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: {
        required: true,
        type: String,
    }
})
</script>