<template>
     <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">{{title}}</h1>
</template>

<script setup>
const props =  defineProps({
    title : {
        required : true,
        type : String,
    }
});
</script>