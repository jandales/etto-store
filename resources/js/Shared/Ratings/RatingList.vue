<template>
    <List class="flex gap-3 items-center mb-2">
        <TextContent :type="'label'" class="font-semibold">{{ rating.rate }}</TextContent>
        <StarIcon class="text-yellow-500 h-5 w-5 flex-shrink-0" />
        <ProgressBar :percentage="rating.average" />
        <div class="w-12 text-right">
            {{ rating.average }}
        </div>
    </List>
</template>

<script setup>
import TextContent from '@/Shared/TextContext';
import ProgressBar from '@/Shared/ProgressBar.vue'
import { StarIcon } from '@heroicons/vue/20/solid'
import List from '@/Shared/List';

defineProps({
    rating: Object,
})
</script>