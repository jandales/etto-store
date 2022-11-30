<template>
<div class="mx-auto max-w-2xl p-8 lg:max-w-7xl">
    <div class="flex">
        <div class="w-2/5">
           <div class="max-w-sm">
                <Ratings :ratings="ratings"  />
            </div>
        </div>
        <div class="w-3/5 pl-12">     
            <ReviewItem 
                v-for="(review, index) in reviews" 
                :key="review.uuid" 
                :review="review" 
                :index="index + 1"
                :count="reviews.length"
                @delete="destroy"               
            />
            <Spinner v-if="isloadingMore" />
            <TextContent :type="'span'" v-if="!isloadingMore && next_page " 
                @click="handleLoadMoreReviews" 
                class="block text-center cursor-pointer text-indigo-500">
                Load more reviews
             </TextContent>
        </div>
    </div>
  
   
</div>



</template>

<script setup>
import { ref, defineAsyncComponent } from 'vue'
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';
import TextContent from '../TextContext';
import ReviewItem from './ReviewItem.vue';
import Ratings from '@/Shared/Ratings/Ratings.vue';
// async components
const Spinner = defineAsyncComponent(() => import('../../Shared/Loading.vue'))


const props = defineProps({
    reviews: Object,
    ratings: Object,
    product_uuid: {
        required: true,
        type : String,
    },
   
})

const reviews = ref(props.reviews.data);
const next_page = ref(props.reviews.links.next);
const isloadingMore = ref(false);

const destroy = (id) => {
    Inertia.delete(`/review/${id}/destroy`)
}



const handleLoadMoreReviews = async() => {

    if (next_page.value == null) return;

    isloadingMore.value = true;

    try {
        const response = await axios.get(next_page.value);
        const { data, links } = response.data;
        reviews.value = [...reviews.value, ...data];
        next_page.value = links.next;
    } catch (err)    {
        console.log(err);
    } finally {
        isloadingMore.value = false;
    }   
  
}


</script>