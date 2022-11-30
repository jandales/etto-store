<template>  
    <div class="bg-gray-200 relative h-3 w-full rounded-2xl">
        <div
            class="bg-yellow-500 absolute top-0 left-0 flex h-full items-center justify-center rounded-2xl text-xs font-semibold text-white"            
            :style="{ width: percentage }">   
        </div>
    </div>   
</template>
<script setup>
defineProps({
    percentage: {
        type: String, 
        default : '0%'   
    }
})
</script>