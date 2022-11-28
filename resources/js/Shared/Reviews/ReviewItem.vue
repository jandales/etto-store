<template>
        <div  :class="[index == count ? 'border-b-0' : 'border-b', 'mb-12 pb-12'] ">
                <div class="flex gap-4">
                        <div class="w-12 flex -space-x-2 overflow-hidden">
                            <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white"
                                src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" />
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <TextContent :type="tag.label" class="block text-gray-900 font-semibold">{{ review.user.display_name }}
                                </TextContent>
                                <TextContent :type="tag.label"
                                    v-if="$page.props.auth.user && review.user.uuid == $page.props.auth.user.data?.uuid"
                                    @click="destroy(review.uuid)" class="text-rose-400 cursor-pointer hover:text-rose-700">Delete
                                </TextContent>
                            </div>
                            <TextContent :type="tag.label" class="block text-gray-500">{{ review.date }}</TextContent>
                            <ReviewRating :average="review.rate" />
                        </div>
                </div>
    <TextContent :type="tag.p" class="block text-gray-500">
        {{ review.body }}
    </TextContent>
                

        </div>
</template>

<script setup>
import ReviewRating from '@/Shared/Reviews/ReviewRating.vue'
import TextContent from '../TextContext'
import { tag } from '@/composable/tag'

defineProps({
    review: Object,
    count: Number,
    index: Number,
})

</script>