<template>
<div class="mx-auto max-w-2xl p-8 lg:max-w-7xl">
   <div class="flex items-center justify-between border-b py-2 mb-12">
    <TextContent :type="'h1'" class="text-3xl font-bold text-gray-900">Product Reviews</TextContent>
    <span @click="openModal = true" class="text-indigo-600 cursor-pointer hover:text-indigo-500">Write review</span>
   </div>
    <!--review item-->
    <div class="flex gap-4 mb-12">
        <div class="w-10 flex -space-x-2 overflow-hidden">
        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="" />
        </div>
        <div class="flex-1 pb-12 border-b">
            <TextContent :type="'label'" class="block text-gray-900 font-semibold">Jesus Andales</TextContent>
            <TextContent :type="'label'" class="block text-gray-500">Febraury 12, 2021</TextContent>     
            <ReviewRating :average="4"/>
            <TextContent :type="'p'" class="block text-gray-500">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature
                from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,
                looked up one of the more obscure Latin words, consectetur
            </TextContent>   
        </div>
    </div>

    <div class="flex gap-4">
        <div class="w-10 flex -space-x-2 overflow-hidden">
            <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="" />
        </div>
        <div class="flex-1 pb-12 border-b">
            <TextContent :type="'label'" class="block text-gray-900 font-semibold">Jesus Andales</TextContent>
            <TextContent :type="'label'" class="block text-gray-500">Febraury 12, 2021</TextContent>
            <ReviewRating :average="4" />
            <TextContent :type="'p'" class="block text-gray-500">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                Latin literature
                from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College
                in Virginia,
                looked up one of the more obscure Latin words, consectetur
            </TextContent>
        </div>
    </div>
</div>
<ReviewWriteModal :state="openModal" @close="openModal=false"></ReviewWriteModal>
</template>
<script setup>
import {ref} from 'vue'
import ReviewRating from '@/Shared/Reviews/ReviewRating.vue'
import TextContent from '../TextContext';
import ReviewWriteModal from './Modal/ReviewWriteModal.vue'


defineProps({
    reviews : Array
})

const openModal = ref(false)


</script>