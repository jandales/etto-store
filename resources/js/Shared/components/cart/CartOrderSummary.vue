<template>
                <div class="bg-slate-50 rounded-md  px-6 py-8">
                  <h1 class="text-lg font-semibold tracking-tight text-slate-90">Order Summary</h1>

                  <ul class="w-full mt-4">
                     <li class="flex justify-between  py-4 border-b">
                        <label class="text-gray-500">Subtotal</label>
                        <label class="text-slate-90 font-semibold">{{ subtotal }}</label>
                     </li>
                     <li class="flex justify-between  py-4 border-b">
                        <label class="text-gray-500">Shipping estimate</label>
                        <label class="text-slate-90 font-semibold">₱0.00</label>
                     </li>
                     <li class="flex justify-between  py-4 border-b">
                        <label class="text-gray-500">Tax estimate</label>
                        <label class="text-slate-90 font-semibold">₱0.00</label>
                     </li>
                  </ul>

                  <div class="flex justify-between mt-4">
                     <h2 class="text-lg font-semibold tracking-tight text-slate-90">Order total</h2>                    
                     <label class="text-lg font-semibold tracking-tight text-slate-90">{{ subtotal }}</label>
                  </div>

                  <div class="mt-6">
                        <Link href="/checkout" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</Link>
                  </div>

            </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
const props = defineProps({
   subtotal: {
      type: Number,
      default  : 0.00
   }
});
</script>