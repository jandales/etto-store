<template>
    <div  class="absolute top-0 left-0 flex items-center justify-center backdrop-blur-sm bg-white/30  w-full h-full">
        <ClipLoader :color="'#4b0082'" />
    </div>
</template>
<script setup>
import ClipLoader from 'vue-spinner/src/ClipLoader.vue'
</script>