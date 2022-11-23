<script setup>

import { ref, onMounted } from 'vue';

const observerElement = ref(null)

const emit = defineEmits(['handler'])

const handler = () => {
    emit('handler');
}

const handleScroll = async () => {

    const element = observerElement.value;

    const observer = new IntersectionObserver(([entry]) => {
        if (entry && entry.isIntersecting) {
            handler();
        }
    });
    
    observer.observe(element);
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll())
})

</script>
<template>
    <div ref="observerElement" class="p-1 w-full">
    </div>
</template>