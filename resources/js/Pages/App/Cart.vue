<template>
  <AppLayout>
     <PageWrapper>
        <PageTitle :title="title" />
        <div v-if="items.length > 0" 
            class="w-full pt-10 pb-16 lg:grid  lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-16 lg:pt-16 lg:pb-24">
          <div class="lg:col-span-2">
            <CartList :items="items" />
          </div>
          <div class="mt-12 lg:mt-0 lg:col-span-1">
              <CartOrderSummary :subtotal="subtotal" />
          </div>         
        </div>
        <div v-else class="mt-12">
            <h3 class="text-gray-500 text-2xl">Your cart is currently empty.</h3>
        </div>
      </PageWrapper>
  </AppLayout>
</template>

<script setup>
import { computed } from 'vue';
import AppLayout from '@/Shared/Layouts/App.vue'
import PageTitle from '@/Shared/components/PageTitle.vue'
import PageWrapper from '@/Shared/components/PageWrapper.vue'
import CartList from '@/Shared/components/cart/CartList.vue';
import CartOrderSummary from '@/Shared/components/cart/CartOrderSummary.vue'
import useCurrency from '@/Composable/currency';

const { currencyFormat } = useCurrency();
const title = 'Shopping Cart';

const props = defineProps({
  cart : Object
})

const subtotal = computed(() => {
  let { subtotal } = props.cart;
  return currencyFormat(subtotal)
});

const items = computed(() => {
  let { data } = props.cart.items;
  return data.map((item) => {
    item.product.price = currencyFormat(item.product.price)
    item.subtotal = currencyFormat(item.subtotal)
    return item;
  })

})



</script>