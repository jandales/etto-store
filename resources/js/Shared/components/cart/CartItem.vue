<template>
    <li v-if="item" class="relative border-t py-12 last:border-b">
        <div class="flex justify-between ">
            <CartProduct :item="item" />
            <CartQty v-model="form.qty" :disabled="form.processing" class="hidden lg:block" />
            <CartRemove @click="handleDestroy" class="hidden lg:block" />
        </div>  
        <CartProccess v-if="form.processing"  />
    </li>
</template>

<script setup>

import { watch, computed, defineAsyncComponent } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'

import CartProduct from './CartProduct.vue'
import CartQty from './CartQty.vue'
import CartRemove from './CartRemove.vue'

const CartProccess = defineAsyncComponent(() => import('./CartProccess.vue'))

const props = defineProps({
    item : Object
})

const form = useForm({
    qty: props.item.qty,
})

const handleUpdateQty = () => {
    form.put(`/cart/update/item/${props.item.id}/qty`);
}

const handleDestroy = () => {
    form.delete(`/cart/destroy/${props.item.id}`)
}

const quantity = computed( () => {
    return form.qty;
});

watch(quantity, value => {
    handleUpdateQty()
})

</script>