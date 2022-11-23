<script setup>

import CollectionItem from './CollectionItem.vue'
defineProps({
  collection: Array,
})



</script>
<template>
  <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
    <CollectionItem v-for="item in collection" :key="item.name" :item="item" />
  </div>
</template>