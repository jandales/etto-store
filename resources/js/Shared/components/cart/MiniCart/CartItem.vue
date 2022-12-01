<template>
    <li  class="relative flex py-6">
        <CartImage :src="item.product.image.src" :alt="item.product.image.alt"/>
    
        <div class="ml-4 flex flex-1 flex-col">
            <div>
                <CartDetails :item="item" />
            </div>
            <div class="flex flex-1 items-end justify-between text-sm">
                <CartQty v-model="form.qty" />
                <!-- <p class="text-gray-500">Qty {{ item.qty }}</p>     -->
                <div class="flex">
                    <button @click="handleRemove" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                </div>
            </div>
        </div>

        <CartProccess v-if="form.processing" /> 

    </li>
</template>

<script setup>

import CartImage from './CartImage.vue'
import CartDetails from './CartDetails.vue'
import CartQty from '../CartQty.vue';

import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed, watch, defineAsyncComponent } from 'vue';
const { cart } = usePage().props.value;
const CartProccess = defineAsyncComponent(() => import('../CartProccess.vue'))

const props = defineProps({
    item : Object,
})

const emits = defineEmits(['remove'])

const form = useForm({
    qty : props.item.qty,
})

// flags 




const handleUpdateQty = () => {
    const { id }= props.item
    form.put(`/cart/update/item/${id}/qty`);
    console.log(cart)
    
}

const handleRemove = () => {
    const { id } = props.item
    form.delete(`/cart/destroy/${id}`);
    emits('remove', id);
}

const quantity = computed(() => {
    return form.qty;
});

watch(quantity, value => {
    handleUpdateQty()
})








</script>