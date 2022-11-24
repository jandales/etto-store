<template>

  <TransitionRoot as="template" :show="cartState">
    <Dialog as="div" class="relative z-10" >
      <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700" enter-from="translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0" leave-to="translate-x-full">
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div  class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                  <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                      <DialogTitle class="text-lg font-medium text-gray-900">Shopping cart</DialogTitle>
                      <div class="ml-3 flex h-7 items-center">
                        <button type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500" @click=toggleCart(false)>
                          <span class="sr-only">Close panel</span>
                          <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                      </div>
                    </div>
 
                    <div class="mt-8">
                      <div class="flow-root">
                        <CartList v-if="cart && cart.items.length > 0">
                          <CartItem v-for="item in items" :key="item.id" :item="item" @remove="getCart" />
                        </CartList>
                        <div v-if="cart && cart.items.length == 0 && !isLoading">
                          <h2>Your cart is currently empty.</h2>
                        </div>
                        <ClipLoader v-if="isLoading" />
                      </div>
                    </div>
                  </div>

                  <div v-if="cart && cart.items.length > 0" class="border-t border-gray-200 py-6 px-4 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                      <p>Subtotal</p>
                      <p>{{ subtotal }}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                    <div class="mt-6">
                      <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                    </div>
                    <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                      <p>
                        or
                        <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500" @click="open = false">
                          Continue Shopping
                          <span aria-hidden="true"> &rarr;</span>
                        </button>
                      </p>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
  
<script setup>

import { ref, inject, watch, computed,  defineAsyncComponent } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import axios from 'axios'
import useCurrency from '@/Composable/currency';
import CartList from '@/Shared/components/cart/MiniCart/CartList.vue'
import CartItem from '@/Shared/components/cart/MiniCart/CartItem.vue'

const ClipLoader = defineAsyncComponent(() => import('@/Shared/ClipLoader.vue'));
const { currencyFormat } = useCurrency();

const cart = ref(null);
const isLoading = ref(false);
const { cartState, toggleCart } = inject('cart');


const items = computed( () => {
  if (cart.value === null) return [];

  let {  items } = cart.value

  return items.map((item) => {
    item.product.price = currencyFormat(item.product.price)
    item.subtotal = currencyFormat(item.subtotal)
    return item;
  })
})



const subtotal = computed(() => {
  if (cart.value === null) return 0.00;
  let { subtotal } = cart.value
  return currencyFormat(subtotal)
});


const getCart = async () => {
  isLoading.value = items.value.length === 0 ? true : false;
  try {
    let response = await axios.get('/cart');
    cart.value = response.data.cart;
  } catch (error) {
    console.log(error)
  } finally {
    isLoading.value = false
  }
}


watch(cartState, value => {
  
  if (value === false) return;
  getCart();
    
})

</script>