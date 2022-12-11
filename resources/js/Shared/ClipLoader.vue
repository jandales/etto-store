<template>
    <div :class="[size, 'w-full flex h-full items-center justify-center']">
        <ClipLoader :color="'#4b0082'" />
    </div>
</template>
<script setup>
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'
defineProps({
    size: {
        type : String,
        default: 'py-16'
    }
})
</script>