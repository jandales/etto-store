<template>
    <Navigation />
        <div class="min-h-screen">
            <slot></slot>
        </div>  
    <Footer />
    <Cart />
</template>



<script setup>
// This starter template is using Vue 3 <script setup> SFCs
// Check out https://vuejs.org/api/sfc-script-setup.html#script-
import { onMounted } from 'vue';
import axios  from 'axios';
import Navigation from '@/Shared/Navigation/Navigation.vue';
import Footer from '@/Shared/components/Footer.vue';
import Cart from '@/Shared/components/Cart.vue';

import { ref, provide } from 'vue';

const cartState = ref(false);

provide('cart', {
    cartState,
    toggleCart: (state) => cartState.value = state, 
})

onMounted(() => axios.get('/cookie/cart/store'))

</script>