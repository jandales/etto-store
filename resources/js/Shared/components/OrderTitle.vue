<template>
    <div class="flex flex-row justify-between border-b pb-4 lg:border-b-0 lg:pb-0 lg:flex-col lg:mr-8">
            <span class="font-semibold text-gray-900">{{ name }}</span>
            <label class="block text-gray-500 text-sm mt-1">{{ value }}</label>
    </div>
</template>
<script setup>
const props = defineProps({
    name : {
        required : true,
        type : String,
    },
    value : {
        required : true,
        type : String,
    }
})
</script>