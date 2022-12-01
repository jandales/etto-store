<template>
    <ul class="flex gap-4">
        <List v-for="category in categories"
            :class="[selected == category.name ? 'text-indigo-500' : 'text-gray-500', 'cursor-pointer tracking-wider  hover:text-indigo-500']">
            <Link :href="category.href">{{ category.name }}</Link>
        </List>
    </ul>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import List from '@/Shared/List'
defineProps({
    categories: Array,
    selected : String,
})
</script>