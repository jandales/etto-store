<template>
    <div class="aspect-w-3 aspect-h-4 hidden overflow-hidden rounded-lg lg:block">
        <img :src="image.src" :alt="image.alt" class="h-full w-full object-cover object-center" />
    </div>
</template>
<script setup>
defineProps({
    image : Object
})
</script>