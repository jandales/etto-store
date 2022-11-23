<template>
     <ul class="flex flex-col">     
            <CartItem v-for="item in items" :key="item.id" :item="item" />
      </ul>
</template>

<script setup>
import CartItem from './CartItem.vue';

const props =  defineProps({
    items : {
        required : true,
        type : Array,
    }
})






</script>

