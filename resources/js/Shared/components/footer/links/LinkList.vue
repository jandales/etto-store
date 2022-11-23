<script setup>

const props =  defineProps({
    title : {
        required : true,
        type : String,
    },
    links : { 
        required : false,
        type: Array
    }
});




</script>
<template>
        <div class="flex flex-col">
            <h2 class="text-base font-bold text-gray-900">{{ title }}</h2>
                <ul class="flex flex-col mt-4">
                    <li v-for="link in links" :key="link.name" :href="link.url" class="mb-4"><a href="" class="text-base">{{ link.name }}</a> </li>
                    <!-- <router-link></router-link> -->
                </ul>
        </div>
</template>