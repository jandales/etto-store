<template>
     <div class="mt-10">
        <h3 class="text-sm font-medium text-gray-900">Highlights</h3>

        <div class="mt-4">
        <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
            <li v-for="highlight in highlights" :key="highlight" class="text-gray-400">
            <span class="text-gray-600">{{ highlight }}</span>
            </li>
        </ul>
        </div>
    </div>
</template>

<script setup>
const props =  defineProps({
    highlights : {
        required : true,
        type : Array,
    }
})
</script>