<template>
        <div class="flex justify-between text-base font-medium text-gray-900">        
            <h3>           
                <a href="#">{{ item.product.name }}</a>
            </h3>
            <p class="ml-4">{{ item.product.price }}</p>
        </div>
        <p class="mt-1 text-sm text-gray-500">{{ item.attributes.color }}</p>
</template>

<script setup>
defineProps({
    item : Object,
})
</script>