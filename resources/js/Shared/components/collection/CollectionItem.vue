<script setup>

const prop = defineProps({
    item: {
        required: true,
        type: Object,
    }
})
</script>
<template>
    <div :key="item.name" class="group relative">
        <div
            class="relative h-80 w-full overflow-hidden rounded-lg bg-white group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
            <img :src="item.image" :alt="item.name" class="h-full w-full object-cover object-center" />
        </div>
        <h3 class="mt-6 text-sm text-gray-500">
            <a>
                <span class="absolute inset-0" />
                {{ item.name }}
            </a>
        </h3>
        <p class="text-base font-semibold text-gray-900">{{ item.description }}</p>
    </div>
</template>