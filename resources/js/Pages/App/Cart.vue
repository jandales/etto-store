<template>
  <AppLayout>
     <PageWrapper>
        <PageTitle :title="title" />
        <div class="w-full pt-10 pb-16 lg:grid  lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-16 lg:pt-16 lg:pb-24">
          <div class="lg:col-span-2">
            <CartList :items="cart.items.data" />
          </div>
          <div class="mt-12 lg:mt-0 lg:col-span-1">
              <CartOrderSummary />
          </div>         
        </div>
      </PageWrapper>
  </AppLayout>
</template>

<script setup>

import AppLayout from '@/Shared/Layouts/App.vue'
import PageTitle from '@/Shared/components/PageTitle.vue'
import PageWrapper from '@/Shared/components/PageWrapper.vue'
import CartList from '@/Shared/components/cart/CartList.vue';
import CartOrderSummary from '@/Shared/components/cart/CartOrderSummary.vue'

const title = 'Shopping Cart';

defineProps({
  cart : Object
})

</script>