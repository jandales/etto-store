<template>
    <AppLayout>
        <Hero></Hero>
        <Collection :collection="collection"></Collection>
        <Carousell :products="featured_products"></Carousell>
    </AppLayout>
</template>

<script setup>
// Layouts
import AppLayout from '@/Shared/Layouts/App.vue';
// components
import Collection from '@/Shared/components/collection/Collection.vue'
import Carousell from '@/Shared/components/carousell/Carousell.vue'
import Hero from '@/Shared/components/hero/Hero.vue';

defineProps({
    collection: Array,
    featured_products: Array,
})

</script>



