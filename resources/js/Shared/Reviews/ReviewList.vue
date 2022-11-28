<template>
<div class="mx-auto max-w-2xl p-8 lg:max-w-7xl">
    <div class="flex">
        <div class="w-2/5">
           <div class="max-w-sm">
            <h1 class="block text-3xl font-bold">Customer Reviews</h1>
            <div class="flex items-center mt-2">
                <ReviewRating :average="ratings.average" />
                <label class="ml-4">Based on {{ ratings.total_reviews }} reviews</label>
            </div>
            
            <ul class="mt-4">
                <li v-for="rating in ratings.ratings" class="flex gap-3 items-center mb-2">
                    <label class="font-semibold">{{ rating.rate }}</label>
                    <StarIcon class="text-yellow-500 h-5 w-5 flex-shrink-0" />
                    <ProgressBar :percentage="rating.average" />
                    <div class="w-12 text-right">
                        {{ rating.average }}
                    </div>
                </li>               
            </ul>
            <div class="mt-8">
                <h1 class="block text-2xl font-bold">Share your thoughts</h1>
                <p class="text-gray-700 mt-2 mb-4">if you've used this product, share your thoughts with other customers</p>
                
            </div>
                <span v-if="$page.props.auth.user" @click="openModal = true"
                    class="block py-2 text-center border rounded-md font-semibold text-gray-900 cursor-pointer hover:bg-indigo-500 hover:text-white">Write a review</span>

                <Link v-else href="/login" class="block py-2 text-center border rounded-md font-semibold text-gray-900 cursor-pointer hover:bg-indigo-500 hover:text-white">Write review</Link>
            
           </div>
        </div>
        <div class="w-3/5 pl-12">
            <!-- <div class="flex items-center justify-between border-b py-2 mb-12">               
                <span v-if="$page.props.auth.user" @click="openModal = true"
                    class="text-indigo-600 cursor-pointer hover:text-indigo-500">Write review</span>
                <Link v-else href="/login" class="text-indigo-600 cursor-pointer hover:text-indigo-500">Write review</Link>
            </div> -->
            <!--review item-->
            <ReviewItem v-for="(review, index) in reviews" :key="review.uuid" :review="review" :index="index + 1"
                :count="reviews.length" />
        </div>
    </div>
  
   
</div>

<WriteModal 
    v-if="openModal"
    :state="openModal"  
    :product_uuid="product_uuid"
    @close="openModal=false" 
/>

</template>

<script setup>
import { ref, defineAsyncComponent} from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'
import TextContent from '../TextContext';
import { tag } from '@/composable/tag'
import ProgressBar from '../ProgressBar.vue';

import { StarIcon } from '@heroicons/vue/20/solid'

import ReviewItem from './ReviewItem.vue';
import ReviewRating from './ReviewRating.vue';

const WriteModal = defineAsyncComponent(() => import('./Modal/ReviewWriteModal.vue'));

defineProps({
    reviews: Array,
    product_uuid: {
        required: true,
        type : String,
    },
    ratings : Array,
})

const destroy = (id) => {
    Inertia.delete(`/review/${id}/destroy`)
}

const openModal = ref(false)

</script>