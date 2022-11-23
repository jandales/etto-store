<template>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      <BaseTitle :title="title" :link="link" class="tracking-tight" />
      <CarousellList :products="products" />
    </div>
  </div>
</template>
  
<script setup>
import BaseTitle from '../BaseTitle.vue';
import CarousellList from './CarousellList.vue';

const title = 'Featured Products'
defineProps({
  products: Array,
})
const link = {
  title: 'Browse all products',
  url: null,
}
</script>