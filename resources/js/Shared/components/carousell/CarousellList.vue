<script setup>
import CarousellProduct from './CarousellProduct.vue';
defineProps({
  products: Array,
})
</script>
<template>
  <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
    <CarousellProduct v-for="product in products" :key="product.id" :product="product" />
  </div>
</template>