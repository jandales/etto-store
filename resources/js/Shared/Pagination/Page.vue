<template>
    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
    <a :href="page.link"
        class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50  focus:z-20"
        :class="{ 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': isActive }">{{
        page.name
        }}</a>
</template>

<script setup>
defineProps({
    page: {
        type: Object,
        default: {
            link: '#',
            name: 1,
        }
    },
    isActive: {
        type: Boolean,
        default: false,
    }
})
</script>

