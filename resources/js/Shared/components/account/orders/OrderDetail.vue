<template>
    <AccountPageHeading :title="title">     
    </AccountPageHeading>
    <div class="mt-4">
        <label for="" class="block text-gray-900">Order number</label>
        <a href="#" class="block text-indigo-500">56454856487454518778</a>
    </div>
    <div class="mt-4">
        <label for="" class="block text-gray-900">Tracking number</label>
        <a href="#" class="block text-indigo-500">56454856487454518778</a>
    </div>
    <div class="border-t border-b py-8 mt-4">
        <div class="flex w-full gap-4">
            <div class="flex w-full">
                            <div class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200  lg:w-40 lg:h-40">
                                <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg" class="h-full w-full object-cover object-center">
                            </div>
                            <div class="ml-4 w-full flex flex-col lg:w-auto">
                                <h3 class="font-semibold">Product 1</h3>
                                <div class="w-full grid grid-cols-2">
                                    <span class="text-gray-900 font-semibold">
                                        Size
                                        <span class="text-gray-500 ml-2">L</span>
                                    </span>
                                    <span class="text-gray-900 font-semibold">
                                        Color
                                        <span class="text-gray-500 ml-2">G</span>
                                    </span>
                                </div> 
                                <div class="w-full grid grid-cols-2">
                                    <span class="text-gray-900 font-semibold">
                                        Quantity
                                        <span class="text-gray-500 ml-2">1</span>
                                    </span>                                 
                                    <span class="text-gray-900 font-semibold">
                                        Price
                                        <span class="text-gray-500 ml-2">$50.00</span>
                                    </span>
                                </div>             
                            </div>
            </div>

        </div>
    </div>

    <div class="w-full grid grid-cols-2 gap-8 py-8 border-b">
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Shipping address</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{order.shipping}}
            </p>
        </div>
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Billing address</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                {{order.billing}}
            </p>
        </div>
    </div>

    <div class="w-full grid grid-cols-2 gap-8 py-8  border-b">
        
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Payment Method</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                Paypal
            </p>
        </div>
        <div>
            <h3 class="text-base text-gray-900 font-semibold">Shipping Method</h3>
            <p class="text-wrap text-gray-700 mt-2 capitalize">
                Method 1
            </p>
        </div>

    </div>


    <div class="w-full py-8  bg-gray-100 rounded-md p-4 mt-8 lg:w-72 lg:ml-auto">
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Subtotal</span>
            <span class="text-gray-900">$50.00</span>
        </div>
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Discount</span>
            <span class="text-gray-900">$0.00</span>
        </div>
        <div class="flex justify-between mb-4">
            <span class="text-gray-900 font-semibold">Shipping</span>
            <span class="text-gray-900">$10.00</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-900 font-semibold">Total</span>
            <span class="text-gray-900 font-semibold">$60.00</span>
        </div>
    </div>

</template>
<script setup>
import AccountPageHeading from '../../AccountPageHeading.vue';
const title = 'Order Details'

const order = 
    { 
        number : 'WU1323123123',
        order_placed : 'Janaury 22, 2022',
        amount : '$300.00',
        products : [
            {
                id: 1,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
                price: '$35.00',
                color: 'Black',
                qty : 1,
                status : 'Jan 25, 2022'
                },
                {
                id: 2,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
                price: '$35.00',
                color: 'Black',
                qty : 1,
                status : 'Jan 25, 2022'
                },
                {
                id: 3,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
                qty : 1,
                price: '$35.00',
                color: 'Black',
                status : 'Jan 25, 2022'
                },
                {
                id: 4,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-04.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
                price: '$35.00',
                qty : 1,
                color: 'Black',
                status : 'Jan 25, 2022'
                },
        ],
        shipping : 'purok 2 brgy. lagundi allen Norther Samar, 2123',
        billing : '45F, Aggoncillo Santa Lucia Nocaliches QC, 1117',
        
    }
</script>
