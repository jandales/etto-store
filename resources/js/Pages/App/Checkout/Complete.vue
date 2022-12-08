<template>
    <div class="mx-auto w-full max-w-3xl">

   
    <div class="flex justify-between pt-28 mb-2">
        <h2 class="text-indigo-500 ">Thank you!</h2>
        <a  class="text-indigo-500" href="/">Back to home</a>
    </div>
    <h1 class="text-gray-900 text-4xl font-bold mb-2">Purchasing our product</h1>
    <p class="text-base text-gray-500 py-1 mb-2">Your order #{{(order.number)}} has order shipped and will be with you soon</p>

    <div class="mt-4">
        <div v-for="item in order.items" class="flex border-b first:border-t py-10">
            <div class="w-44">
                <div class="w-44 h-44 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                    <img class="h-full w-full object-cover object-center"
                    :src="item.product.image.src" :alt="item.product.image.alt"
                        />
                </div>
            </div>
            <div class="flex-1 ml-4 flex flex-col">
                <label class="font-medium text-gray-900 capitalize">{{ item.product.name }}</label>
                <p class="text-gray-500">{{ item.product.description}}</p>
                <div class="mt-auto">
                    <label class="inline-block text-gray-900 font-medium mr-8">Qauntity <span class="text-gray- ml-2">{{ item.qty }}</span></label>
                    <label class="inline-block text-gray-900 font-medium">Price <span class="text-gray-500 ml-2">{{ item.price }}</span></label>
                </div>
            </div>
        </div>

        <div class="flex">
                <div class="w-48"></div>
                <div class="flex-1 ml-4 ">
                    <div class="grid grid-cols-2 border-b py-10">
                        <div >
                            <h2 class="font-medium text-gray-900">Shipping Address</h2>
                            <span class="block text-gray-500">{{order.shipping.name.fullname }}</span>
                            <span class="block text-gray-500">{{`${order.shipping.street} ${order.shipping.city}`}}</span>
                            <span class="block text-gray-500">{{`${order.shipping.region}, ${order.shipping.country}`}}</span>
                        </div>
                        <div >
                            <h2 class="font-medium text-gray-900">Billing Address</h2>
                            <span class="block text-gray-500">{{order.billing.name.fullname }}</span>
                            <span class="block text-gray-500">{{`${order.billing.street} ${order.billing.city}`}}</span>
                            <span class="block text-gray-500">{{`${order.billing.region}, ${order.billing.country}`}}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 border-b py-10">
                            <div>
                                <h2 class="font-medium text-gray-900">Payment Method</h2>
                                <span class="block text-gray-500 capitalize">{{order.payment.provider}}</span>
                                <span class="block text-gray-500">{{order.payment.reference_number}}</span>                               
                            </div>
                            <div>
                                <h2 class="font-medium text-gray-900">Shipping Method</h2>
                                <span class="block text-gray-500">{{ order.payment.shipping_method.name   }}</span>
                                <span class="block text-gray-500">{{ order.payment.shipping_method.description}}</span>                           
                            </div>
                    </div>

                    <div class="w-full border-b py-10">
                        <div class="flex justify-between mb-4">
                                <span class="font-medium">Subtotal</span>
                                <span class="text-gray-500">$0</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="font-medium">Discount</span>
                            <span class="text-gray-500">$0</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="font-medium">Shipping</span>
                            <span class="text-gray-500">$0</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="font-medium">Total</span>
                            <span class="text-gray-500">$0</span>
                        </div>
                    </div>
               
                </div>
        </div>
    </div>
    </div>
</template>
<script setup>
import { ref } from 'vue'
const props = defineProps({
    order: Object,
})

const order = ref(props.order.data)
const { shipping_method } = props.order;
</script> 