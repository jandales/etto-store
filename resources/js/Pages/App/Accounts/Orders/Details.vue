<template>

    <Account>
    <AccountPageHeading :title="title">     
    </AccountPageHeading>
    <div class="mt-4 flex  items-center justify-between">
      <div>
        <label for="" class="block text-gray-900">Order number</label>
        <a href="#" class="block text-indigo-500">{{ order.data.number }}</a>
      </div>
      <div class="capitalize bg-green-500 text-center text-white px-4 py-2 rounded-md">
        {{order.data.status}}
      </div>
    </div>
    <!-- <div class="mt-4">
        <label for="" class="block text-gray-900">Tracking number</label>
        <a href="#" class="block text-indigo-500">{{ order.data.number  }}</a>
    </div> -->
    <div v-for="item in order.data.items" class="border-t py-8 mt-4">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-2">
                <div class="flex w-full">
                    <div class="w-16 h-16 p-2 flex-shrink-0 overflow-hidden rounded-md border border-gray-200  lg:w-36 lg:h-36">
                        <img :src="item.product.image.src" :alt="item.product.image.alt"
                            class="h-full w-full object-cover object-center">
                    </div>
                    <div class="ml-4 w-full flex flex-col lg:w-auto">
                        <h3 class="font-semibold capitalize">{{ item.product.name }}</h3>
                        <div v-for="(value, key, index) in item.properties" :key="index" class="w-full grid grid-cols-2">
                            <span class="text-gray-900 font-semibold text-sm capitalize">
                                {{ key }}
                                <span class="text-gray-500 ml-2">{{ value }}</span>
                            </span>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="col-span-2 grid grid-cols-2 gap-4"> 
                <div>
                    <span class="text-gray-900 font-semibold text-sm">
                        Price
                        <span class="text-gray-500 ml-2">{{item.price}}</span>
                    </span>
                </div>
                <div>
                    <span class="text-gray-900 font-semibold text-sm">
                        Qty
                        <span class="text-gray-500 ml-2">{{ item.qty }}</span>
                    </span>
                </div>
            </div>

            

        </div>
    </div>

    <div class="w-full grid grid-cols-2 gap-8 py-8 border-b border-t">
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Shipping address</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{order.data.shipping.address}}
            </p>
        </div>
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Billing address</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{order.data.billing.address}}
            </p>
        </div>
    </div>

    <div class="w-full grid grid-cols-2 gap-8 py-8  border-b">
        
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Payment Method</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{order.data.payment.provider}}
            </p>
        </div>
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Shipping Method</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{ order.data.payment.shipping_method.name }}
            </p>
        </div>

    </div>


    <div class="w-full py-8  bg-gray-100 rounded-md p-4 mt-8 lg:w-72 lg:ml-auto">
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Subtotal</span>
            <span class="text-gray-900">{{ order.data.total }}</span>
        </div>
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Discount</span>
            <span class="text-gray-900">{{ order.data.discount }}</span>
        </div>
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Shipping</span>
            <span class="text-gray-900">{{ order.data.payment.shipping_method.amount }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-900 font-semibold">Total</span>
            <span class="text-gray-900 font-semibold">{{ order.data.total }}</span>
        </div>
    </div>
    
</Account>
</template>
<script setup>

import Account from '@/Shared/Layouts/Account.vue';
import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue';

const title = 'Order Details'
const props = defineProps({
    order : Object,
})
// const order = 
//     { 
//         number : 'WU1323123123',
//         order_placed : 'Janaury 22, 2022',
//         amount : '$300.00',
//         products : [
//             {
//                 id: 1,
//                 name: 'Basic Tee',
//                 href: '/collection/men/1',
//                 imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
//                 imageAlt: "Front of men's Basic Tee in black.",
//                 price: '$35.00',
//                 color: 'Black',
//                 qty : 1,
//                 status : 'Jan 25, 2022'
//                 },
//                 {
//                 id: 2,
//                 name: 'Basic Tee',
//                 href: '/collection/men/1',
//                 imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg',
//                 imageAlt: "Front of men's Basic Tee in black.",
//                 price: '$35.00',
//                 color: 'Black',
//                 qty : 1,
//                 status : 'Jan 25, 2022'
//                 },
//                 {
//                 id: 3,
//                 name: 'Basic Tee',
//                 href: '/collection/men/1',
//                 imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
//                 imageAlt: "Front of men's Basic Tee in black.",
//                 qty : 1,
//                 price: '$35.00',
//                 color: 'Black',
//                 status : 'Jan 25, 2022'
//                 },
//                 {
//                 id: 4,
//                 name: 'Basic Tee',
//                 href: '/collection/men/1',
//                 imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-04.jpg',
//                 imageAlt: "Front of men's Basic Tee in black.",
//                 price: '$35.00',
//                 qty : 1,
//                 color: 'Black',
//                 status : 'Jan 25, 2022'
//                 },
//         ],
//         shipping : 'purok 2 brgy. lagundi allen Norther Samar, 2123',
//         billing : '45F, Aggoncillo Santa Lucia Nocaliches QC, 1117',
        
//     }
</script>
