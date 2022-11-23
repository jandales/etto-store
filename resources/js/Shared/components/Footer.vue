<script setup>
import Links from './footer/Links.vue'
import Newsletter from './footer/Newsletter.vue';
</script>
<template>
    <div class="bg-gray-100">
        <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">   
            <div class="flex flex-col sm:flex-col lg:flex-row w-full">
                <Links />
                <Newsletter />                
            </div>
            <div class="mt-16 border-b border-gray-200"></div>
            <p class="text-base mt-8">Copyright © 2022 Etto clothing store</p>
        </div>   
  </div>     
</template>