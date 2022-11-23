<template>
    <div class="w-full flex items-center justify-center py-16">
        <PulseLoader :color="'#4b0082'"></PulseLoader>
    </div>
</template>
<script setup>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
</script>