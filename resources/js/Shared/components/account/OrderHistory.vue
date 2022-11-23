<template>

    <AccountPageHeading :title="title">        
        <p class="text-gray-500 mt-2">Check the status of recent orders and  manage returns, and download Invoice</p>
    </AccountPageHeading>

    <div v-for="order in orders">
        <div class="flex flex-col  gap-8 mt-8 bg-gray-100 p-4 rounded-md lg:flex-row lg:items-center">
            
            <OrderTitle  :name="'Date Placed'"  :value="order.order_placed" />
            <OrderTitle  :name="'Order Number'" :value="order.number" />  
            <OrderTitle  :name="'Total Amount'" :value="order.amount"  />  

            <div class="lg:ml-auto">
                <a class="block border text-sm text-center rounded-md px-4 py-2 bg-white font-semibold cursor-pointer text-gray-900 hover:bg-indigo-500 hover:text-white lg:text-left">View Invoice</a>       
            </div>

    </div>

    <div class="flex">
        <!-- sm -->
        <div class="lg:hidden">
            <table class="table-fixed w-full mt-8 lg:hidden">        
            <tbody>
                <tr v-for="product in order.products" class="border-b">
                    <td class="py-4">
                        <div class="flex">
                            <div class="w-14 h-14">
                                <img :src="product.imageSrc" class="w-16 h-16 rounded" :alt="product.imageAlt">
                            </div>
                            <div class="ml-4 flex flex-col lg:items-center">
                                <h3 class="font-semibold">{{ product.name }}</h3>
                                <label class="text-gray-500 lg:hidden">{{ product.price}}</label>
                            </div>
                        </div>
                    </td>               
                    <td class="py-4 text-right">
                        <a href="#" class="text-indigo-500 font-semibold hidden :lg:flex">View Product</a>
                        <a href="#" class="text-indigo-500 font-semibold lg:hidden">View</a>
                    </td>                             
                </tr>           
            </tbody>        
        </table>
        </div>
        <!-- lg -->
        <div class="hidden lg:block">
            <table class="table-fixed w-full mt-8">
            <thead>

                <tr class="lg:border-b">
                    <th class="text-left text-sm text-gray-500 font-normal py-2">Product</th>
                    <th class="text-left text-sm text-gray-500 font-normal py-2">Price</th>
                    <th class="text-left text-sm text-gray-500 font-normal py-2">Status</th>
                    <th class="text-gray-500  text-sm font-normal py-2 text-right">Info</th>
                </tr>    
                
            </thead>
            <tbody>
                <tr v-for="product in order.products" class="border-b">
                    <td class="py-4">
                        <div class="flex">
                            <div class="w-14 h-14">
                                <img :src="product.imageSrc" class="w-16 h-16 rounded" :alt="product.imageAlt">
                            </div>
                            <div class="ml-4 flex flex-col lg:items-center">
                                <h3 class="font-semibold">{{ product.name }}</h3>                          
                            </div>
                        </div>
                    </td>
                    <td class="py-4 text-gray-500">{{ product.price }}</td>
                    <td class="py-4 text-gray-500">Delivered {{ product.status }}</td>
                    <td class="py-4 text-right">
                        <a href="#" class="text-indigo-500 font-semibold">View Product</a>
                    </td>
                                
                </tr>
            </tbody>        
        </table>
        </div>
        
    </div>
    </div>

</template>

<script setup>
import { ref, inject} from 'vue';
import AccountPageHeading from './AccountPageHeading.vue';
import OrderTitle from './orders/OrderTitle.vue';
const menu = inject('menu');

const title = 'Order History';
const orders = [
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
                status : 'Jan 25, 2022'
                },
                {
                id: 3,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
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
                color: 'Black',
                status : 'Jan 25, 2022'
                },
        ]
        
    },
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
                status : 'Jan 25, 2022'
                },
                {
                id: 3,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
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
                color: 'Black',
                status : 'Jan 25, 2022'
                },
        ]
        
    },
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
                status : 'Jan 25, 2022'
                },
                {
                id: 3,
                name: 'Basic Tee',
                href: '/collection/men/1',
                imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                imageAlt: "Front of men's Basic Tee in black.",
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
                color: 'Black',
                status : 'Jan 25, 2022'
                },
        ]
        
    }
]

</script>