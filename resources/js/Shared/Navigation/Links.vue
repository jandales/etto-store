<template>
    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
        <div class="flex h-full space-x-8">
            <Link 
                v-for="page in links.pages" 
                :key="page.name"
                :href="page.href"
                class="flex items-center text-sm font-medium cursor-pointer text-gray-700 hover:text-gray-800">
                {{ page.name }}
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
    links : Object,
})
</script>
