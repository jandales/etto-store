<template>
     <h2 class="sr-only">Product information</h2>
            <div class="flex items-center justify-between">
              <h1 class="text-lg  tracking-tight text-gray-900 sm:text-3xl">{{ product.name }}</h1>
              <p class="text-lg tracking-tight text-gray-900 sm:text-3xl">{{ product.price }}</p>
            </div>
</template>

<script setup>
const props =  defineProps({ 
    product : {
        required : true,
        type : Object,
    }
});
</script>