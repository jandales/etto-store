<template>
    <Account>        
   
    <AccountPageHeading :title="title">        
        <p class="text-gray-500 mt-2">Check the status of recent orders and  manage returns, and download Invoice</p>
    </AccountPageHeading>

    <div v-for="order in orders.data">
        <div class="flex flex-col  gap-8 mt-8 bg-gray-100 p-4 rounded-md lg:flex-row lg:items-center">
            
            <OrderTitle  :name="'Date Placed'"  :value="order.order_placed" />
            <OrderTitle  :name="'Order Number'" :value="order.number" />          
            <OrderTitle  :name="'Total Amount'" :value="order.amount"  />  

            <div class="lg:ml-auto">
                <Link :href="`/account/orders/${order.number}/show`" class="block border text-sm text-center rounded-md px-4 py-2 bg-white font-semibold cursor-pointer text-gray-900 hover:bg-indigo-500 hover:text-white lg:text-left">View Invoice</Link>       
            </div>

    </div>

    <div class="flex">
        <!-- sm -->
        <div class="lg:hidden">
            <table class="table-fixed w-full mt-8 lg:hidden">        
            <tbody>
                <tr v-for="item in order.items" class="border-b">
                    <td class="py-4">
                        <div class="flex">
                            <div class="w-14 h-14">
                                <img :src="item.product.image.src" class="w-16 h-16 rounded" :alt="item.product.image.alt">
                            </div>
                            <div class="ml-4 flex flex-col lg:items-center">
                                <h3 class="font-semibold">{{ item.product.name }}</h3>
                                <label class="text-gray-500 lg:hidden">{{ item.price }}</label>
                            </div>
                        </div>
                    </td>               
                    <td class="py-4 text-right">                        
                        <Link :href="`/product/${item.product.uuid}`" class="text-indigo-500 font-semibold lg:hidden">View</Link>
                    </td>                             
                </tr>           
            </tbody>        
        </table>
        </div>
        <!-- lg -->
        <div class="hidden w-full lg:block">
            <table class="table w-full mt-4">

            <thead>
                <tr class="lg:border-b">
                    <th class="text-left text-sm text-gray-500 font-normal py-4 pr-4">Product</th>
                    <th class="text-left text-sm text-gray-500 font-normal p-4">Price</th>
                    <th class="text-left text-sm text-gray-500 font-normal p-4">Qty</th>
                    <th class="text-left text-sm text-gray-500 font-normal p-4">Subotal</th>
                    <th class="text-left text-sm text-gray-500 font-normal p-4">Status</th>               
                </tr>    
                
            </thead>
            <tbody>
                <tr v-for="item in order.items" class="border-b">                 
                    <td class="py-4 pr-4">
                        <div class="flex">
                            <div class="w-24 h-24 bg-gray-500 rounded border overflow-hidden">
                                <img :src="item.product.image.src" class="w-full h-full" :alt="item.product.image.alt">
                            </div>
                            <div class="ml-4 flex flex-col gap-1">
                                <Link :href="`/product/${item.product.uuid}`" class="font-semibold capitalize hover:underline">{{ item.product.name }}</Link>
                                <ul class="block">
                                    <li v-for="(attribute, key, index) in item.properties" :key="index" class="text-gray-500 capitalize text-sm">{{ `${key} : ${attribute}` }}</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-gray-500">{{ item.price }}</td>
                    <td class="p-4 text-gray-500">
                        <span class="text-left text-sm text-gray-500">Qty : <span class="text-gray-500">{{ item.qty }}</span></span>
                    </td>
                    <td class="p-4 text-gray-500 capitalize">{{ item.total }}</td>

                    <td class="p-4 text-gray-500 capitalize">{{ order.status }}</td>
               
                                
                </tr>
            </tbody>        
        </table>
        </div>
        
    </div>
    </div>

     </Account>

</template>

<script setup>
import { ref, inject } from 'vue';
import { Link } from '@inertiajs/inertia-vue3'
import Account from '@/Shared/Layouts/Account.vue'
import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue';
import OrderTitle from '@/Shared/components/OrderTitle.vue';

const menu = inject('menu');

const title = 'Order History';

const props = defineProps({
    orders: Array
})



</script>