<template>
    <div class="mt-6">
              <h3 class="sr-only">Reviews</h3>
              <div class="flex items-center">
                <div class="flex items-center">                  
                  <StarIcon v-for="rating in ratings" :key="rating" :class="[reviews.average > rating ? 'text-yellow-500' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                </div>
                <p class="sr-only">{{ reviews.average }} out of 5 stars</p>
                <a :href="reviews.href" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ reviews.totalCount }} reviews</a>
              </div>
            </div>
</template>

<script setup>
import { StarIcon } from '@heroicons/vue/20/solid'
const props =  defineProps({
    ratings : { required : true, type : Array},
    reviews : { required : true, type : Object }
})
</script>