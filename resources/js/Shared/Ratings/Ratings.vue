<template>
    <TextContent :type="'h1'" class="block text-3xl font-bold">Customer Reviews</TextContent>
    <div class="flex items-center mt-2">
        <ReviewRating :average="ratings.average" />
        <TextContent :type="'label'" class="ml-4">Based on {{ ratings.total_reviews }} reviews</TextContent>
    </div>

    <ul class="mt-4">
        <RatingList v-for="rating in ratings.ratings" :rating="rating" />
    </ul>
    <div class="mt-8">
        <TextContent :type="'h1'" class="block text-2xl font-bold">Share your thoughts</TextContent>
        <TextContent :type="'p'"  class="text-gray-700 mt-2 mb-4">if you've used this product, share your thoughts with other customers</TextContent>
    </div>

    <TextContent :type="'span'" v-if="$page.props.auth.user" 
        @click="openModal = true"
        class="block py-2 text-center border rounded-md font-semibold text-gray-900 cursor-pointer hover:bg-indigo-500 hover:text-white">
        Write a review
    </TextContent>

    <Link v-else 
        href="/login"
        class="block py-2 text-center border rounded-md font-semibold text-gray-900 cursor-pointer hover:bg-indigo-500 hover:text-white">
        Write review
    </Link>

    <Teleport to="body">
        <WriteModal 
            v-if="openModal" 
            :state="openModal" 
            :product_uuid="product_uuid" 
            @close="openModal=false"
        />
    </Teleport>
</template>
<script setup>
import { ref, defineAsyncComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import TextContent from '@/Shared/TextContext';
import ReviewRating from '@/Shared/Reviews/ReviewRating.vue';
import RatingList from '@/Shared/Ratings/RatingList.vue';

const WriteModal = defineAsyncComponent(() => import('@/Shared/Reviews/Modal/ReviewWriteModal.vue'));

const openModal = ref(false)

defineProps({
    ratings : Object
})
</script>