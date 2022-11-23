<script setup>
const props = defineProps({
    title : {
        required : true,
        type : String,
    },
    link : {
        required : false,
        type : Object,
        default : { title : 'View more', url : null}
    }, 

})
</script>

<template>
    <div class="flex item-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900" v-bind="$attrs">{{ title }}</h2>   
        <a class="ml-6 whitespace-nowrap text-sm font-semibold text-sky-500 cursor-pointer hover:text-sky-600" :href="link.url">{{ link.title }} <span aria-hidden="true">→</span></a>
    </div>
            
</template>