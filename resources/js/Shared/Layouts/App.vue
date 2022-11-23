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
import Navigation from '../components/Navigation.vue';
import Footer from '../components/Footer.vue';
import Cart from '../components/Cart.vue';

import { ref, provide, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';


const cartState = ref(false);

provide('cart', {
    cartState,
    toggleCart: (state) => cartState.value = state, 
})



onMounted(() => axios.get('/cookie/cart/store'))

</script>