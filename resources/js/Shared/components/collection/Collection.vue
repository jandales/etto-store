<template>
  <div class="bg-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
        <BaseTitle :title="title" :link="link" />
        <CollectionList :collection="collection" />
      </div>
    </div>
  </div>
</template>  
<script setup>

import CollectionList from "../collection/CollectionList.vue"
import BaseTitle from '../BaseTitle.vue';

const title = 'Collections';

const link = {
  title: 'Browse all collection',
  url: null,
}

defineProps({
  collection: Array,
})

</script>