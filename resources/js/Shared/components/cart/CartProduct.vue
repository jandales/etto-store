<template>
   
      <div v-if="item" class="flex">

<div class="h-48 w-48 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 lg:h-48 lg:w-48">
   <img :src="item.product.image.src" class="h-full w-full object-cover object-center" :alt="item.product.image.alt"  />
</div>

<div class="ml-4">
      <h1 class="text-base">{{ item.product.name }}</h1>
      <ul class="flex items-center py-2">
         <li class="first:pr-4 border-r ">Gray</li>
         <li class="px-4 last:border-r-0">Large</li>
      </ul>
      <p class="text-grey-900">{{ item.product.price }}</p>
      <CartQty class="mt-4 lg:hidden" />
      <div class="flex justify-center mt-4 lg:hidden">
        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
    </div>
</div>

<div>     
</div>                     
</div> 
</template>
<script setup>
import CartQty from './CartQty.vue';
const props = defineProps({
    item : {
        required : true,
        type : Array,
    }
});
</script>