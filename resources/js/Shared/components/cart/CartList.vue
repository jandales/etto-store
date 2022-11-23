<template>
     <ul class="flex flex-col">     
               <li v-for="item in items" class="border-t py-12 last:border-b">            
                  <div class="flex justify-between ">                     
                     <CartProduct :item="item" />
                     <CartQty class="hidden lg:block"  />
                     <CartRemove  class="hidden lg:block"/>   
                  </div>                                   
               </li>              
            </ul>
</template>

<script setup>
import CartProduct from './CartProduct.vue'
import CartQty from './CartQty.vue'
import CartRemove from './CartRemove.vue'

const props =  defineProps({
    items : {
        required : true,
        type : Array,
    }
})
</script>

