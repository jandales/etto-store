<template>
    <div class="mt-6">
              <TextContent :type="'h3'" class="sr-only">Reviews</TextContent>
              <div class="flex items-center">
                <div class="flex items-center">                  
                  <StarIcon 
                    v-for="rating in range(0, 4)" 
                    :key="rating" 
                    :class="[reviews.average > rating ? 'text-yellow-500' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']" 
                    aria-hidden="true"
                  />
                </div>
                <TextContent 
                    :type="'p'"  
                    class="sr-only">
                    {{ reviews.average }} out of 5 stars
                </TextContent>
                <TextContent 
                    :type="'label'" 
                    class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    {{ reviews.totalCount }} reviews
                </TextContent>
              </div>
    </div>
</template>

<script setup>
import { StarIcon } from '@heroicons/vue/20/solid'
import TextContent from '@/Shared/TextContext';
import { range } from 'lodash';

const props =  defineProps({ 
    reviews : { required : true, type : Object }
})
</script>