<template>
    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img :src="src" :alt="alt" class="h-full w-full object-cover object-center" />
    </div>
</template>

<script setup>
defineProps({
    src: String,
    alt : String,
})
</script>