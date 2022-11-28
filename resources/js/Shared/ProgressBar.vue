<template>
  
        <div class="bg-gray-200 relative h-3 w-full rounded-2xl">
            <div
                :class="[percentageClass, `bg-yellow-500 absolute top-0 left-0 flex h-full items-center justify-center rounded-2xl text-xs font-semibold text-white`]"             
                >
             
            </div>
        </div>
   
</template>
<script setup>
import { computed } from 'vue';

const props = defineProps({
    percentage: {
        type: String,
        default : 0,
    }
})

const percentageClass = computed(() => { return `w-[${props.percentage}%]`})
</script>