<template>
<div class="mx-auto max-w-2xl p-8 lg:max-w-7xl">
   <div class="flex items-center justify-between border-b py-2 mb-12">
    <TextContent :type="'h1'" class="text-3xl font-bold text-gray-900">Product Reviews</TextContent>
    <span v-if="$page.props.auth.user" @click="openModal = true" class="text-indigo-600 cursor-pointer hover:text-indigo-500">Write review</span>
    <Link v-else href="/login"
        class="text-indigo-600 cursor-pointer hover:text-indigo-500">Write review</Link>
   </div>
    <!--review item-->
    <div v-for="(review, index) in reviews" :key="review.uuid" class="flex gap-4 mb-12">  
        <div class="w-10 flex -space-x-2 overflow-hidden">
        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="" />
        </div>
        <div :class="[index + 1 == reviews.length ? 'border-b-0' : 'border-b', 'flex-1 pb-12' ]" >
            <div class="flex justify-between">
                <TextContent :type="'label'" class="block text-gray-900 font-semibold">{{ review.user.display_name }}</TextContent>
                <TextContent :type="'span'" v-if="$page.props.auth.user && review.user.uuid == $page.props.auth.user.data?.uuid" @click="destroy(review.uuid)" class="text-rose-400 cursor-pointer hover:text-rose-700">Delete</TextContent>
            </div>
         
            <TextContent :type="'label'" class="block text-gray-500">{{ review.date }}</TextContent>     
            <ReviewRating :average="review.rate"/>
            <TextContent :type="'p'" class="block text-gray-500">
                {{ review.body }}
            </TextContent>   
        </div>
   
    </div>


</div>
<ReviewWriteModal :state="openModal" @close="openModal=false" :product_uuid="product_uuid"></ReviewWriteModal>
</template>

<script setup>
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'
import ReviewRating from '@/Shared/Reviews/ReviewRating.vue'
import TextContent from '../TextContext';
import ReviewWriteModal from './Modal/ReviewWriteModal.vue'

defineProps({
    reviews: Array,
    product_uuid: {
        required: true,
        type : String,
    }
})

const destroy = (id) => {
    Inertia.delete(`/review/${id}/destroy`)
}

const openModal = ref(false)

</script>