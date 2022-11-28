<template>
    <div class="my-2">
        <h3 class="sr-only">Reviews</h3>
        <div class="flex items-center">
            <div class="flex items-center">
                <StarIcon v-for="index in range" :key="index"               
                    :class="[average > index ? 'text-yellow-500' : 'text-gray-200', size, 'flex-shrink-0']"
                    aria-hidden="true" />
            </div>      
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { StarIcon } from '@heroicons/vue/20/solid'
const range = ref([0, 1, 2, 3, 4])
const props = defineProps({
    average: { required: true, type: Number },
    size: {
        type: String,
        default: 'h-5 w-5',
    }

})
</script>