<template>
    <div class="px-16">
        <div class="w-full h-24  flex items-center justify-center">
            <ul class="flex items-center gap-4">
                <li class="text-gray-900 font-semibold">Cart</li>
                <li>></li>
                <li class="text-gray-900 font-semibold">Billing Information</li>
                <li>></li>
                <li class="text-gray-900 font-semibold">Confirmation</li>
            </ul>
        </div>
        <div class="flex py-10 gap-12">
            <div class="flex-1">
                <div class="w-full mb-12 pb-4">    

                    <a :href="`/checkout/payment/paypal/proccess?amount=${total}&currency=PHP&shipping_method=${selected.id}&shipping_amount=${selected.amount}`">Paypal</a>

                    <div class="flex items-center gap-2 mt-4">
                        <div class="w-full border-b  h-fit"></div>
                        <div>or</div>
                        <div class="w-full border-b  h-fit"></div>
                    </div>
                   
                </div>
                <div class="w-full border-b mb-12 pb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-gray-900 font-semibold">Contact Information</h1>
                         <span v-if="!$page.props.auth.user" class="text-sm">Already have an account? <a href="/checkout" class="text-indigo-500"> Log in</a></span>
                    </div>
                    
                    <FormBlock :label="'Email'" :type="'email'" :name="'email'" v-model="form.email"  />
                </div>                
        
                <div class="w-full  border-b mb-12 pb-6">
                    <h1 class="text-gray-900 font-semibold mb-4">Shipping Information</h1>

                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'First name'" :type="'text'" :name="'firstname'" v-model="form.shipping.firstname" />
                        <FormBlock :label="'Last name'"  :type="'text'" :name="'lastname'" v-model="form.shipping.lastname" />
                    </div>
        
                    <FormBlock :label="'Street'"  :type="'text'"  :name="'street'" v-model="form.shipping.street"/>

                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'City'" :name="'city'" :type="'text'" v-model="form.shipping.city" />
                        <FormBlock :label="'Country'" :name="'country'" :type="'text'" v-model="form.shipping.country" />  

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'Region'" type="'text'" :name="'region'"  v-model="form.shipping.region" />
                        <FormBlock :label="'Postal code'" :type="'number'"  :name="'postal_code'"   v-model="form.shipping.postalCode"/>
                    </div>                
                   
                    <FormBlock :label="'Phone'" :type="'text'" :name="'phone'" v-model="form.shipping.phone" />
        
        
        
                </div>

                <div class="w-full  border-b mb-12 pb-6">
                    <h1 class="text-gray-900 font-semibold mb-4">Shipping Method</h1>
                    <div class="w-full">
                        <div class="w-full">
                            <RadioGroup v-model="selected">
                                <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                                <div class="space-x-8 flex">
                                    <RadioGroupOption as="template" v-for="method in shippingMethods" :key="method.uuid" :value="method"
                                        v-slot="{ active, checked }">
                                        <div :class="[
                                          active
                                            ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                            : '',
                                          checked ? 'bg-sky-900 bg-opacity-75 text-white border-0' : 'bg-white ',
                                        ]"
                                            class="relative flex cursor-pointer border w-1/2 rounded-lg px-5 py-4 shadow-md focus:outline-none">
                                            <div class="flex w-full items-center justify-between">
                                                <div class="flex items-center">
                                                    <div class="text-sm">
                                                        <RadioGroupLabel as="p" :class="checked ? 'text-white' : 'text-gray-900'"
                                                            class="font-medium capitalize">
                                                            {{ method.name }}
                                                        </RadioGroupLabel>
                                                        <RadioGroupDescription as="span"
                                                            :class="checked ? 'text-sky-100' : 'text-gray-500'" class="inline">
                                                            <span class="block mt-2">{{method.description }}</span>
                                                            <span class="block mt-2">${{method.amount }}</span>
                                                           
                                                        </RadioGroupDescription>
                                                    </div>
                                                </div>
                                                <div v-show="checked" class="shrink-0 text-white">
                                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                                        <circle cx="12" cy="12" r="12" fill="#fff" fill-opacity="0.2" />
                                                        <path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </RadioGroupOption>
                                </div>
                            </RadioGroup>
                        </div>
                    </div>
                </div>

                <div class="w-full  border-b mb-12 pb-6">
                    <h1 class="text-gray-900 font-semibold mb-4">Payment</h1>
                    <div id="card-element">

                    </div>
                    <!-- <FormBlock :label="'Name'" />
                    <FormBlock :label="'Card name'"/>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2">
                            <FormBlock :label="'Expirtion Date'" />
                        </div>
                        <div>
                            <FormBlock :label="'CVC'" />
                        </div>
                    </div> -->
                </div>

                <div>

                    <h1 class="text-gray-900 font-semibold mb-4">Billing Information</h1>
                    <div class="mb-4">                        
                        <input type="checkbox" v-model="setBilling" name="billing" id="billing" checked class="mr-2">
                        <label for="">Billing address is the same as shipping address</label>
                    </div>
                    <div v-if="!setBilling">

                 
                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'First name'" :name="'firstname'" :type="'text'" v-model="form.billing.firstname"/>
                        <FormBlock :label="'Last name'" :name="'lastname'" :type="'text'" v-model="form.billing.lastname" />
                    </div>
                    
                    <FormBlock :label="'Street'" :name="'street'" :type="'text'" v-model="form.billing.street" />
                    
                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'City'" :name="'city'" :type="'text'" v-model="form.billing.city"  />
                        <FormBlock :label="'Country'" :name="'country'" :type="'text'" v-model="form.billing.country" />
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock :label="'Region'" :name="'region'" :type="'text'" v-model="form.billing.region" />
                        <FormBlock :label="'Postal code'" :name="'postal_code'" :type="'number'" v-model="form.billing.postalCode" />
                    </div>
                    
                    <FormBlock :label="'Phone'" :type="'text'" :name="'phone'" v-model="form.billing.phone" />

                    </div>

                </div>
                        
            </div>
        
            <div class="w-1/2 px-8">
                <div class="sticky top-12">
                    <h1 class="text-gray-900 font-semibold mb-4">Order Summery</h1>
                            <CartList>
                                <CartItem v-for="item in cart.items.data" :key="item.id" :item="item" />
                            </CartList>
                            
                            <div class="w-full mt-6 border-t">
                                <ul class="border-b mt-6 mb-4">
                                    <li class="flex justify-between mb-4">
                                        <span class="text-gray-500 font-semibold">Subtotal</span>
                                        <span class="text-gray-900 font-semibold">{{ currencyFormat(subtotal) }}</span>
                                    </li>
                                    <li class="flex justify-between mb-4">
                                        <span class="text-gray-500 font-semibold">Shipping</span>
                                        <span class="text-gray-900 font-semibold">{{ currencyFormat(selected.amount) }}</span>
                                    </li>
                                    <li class="flex justify-between mb-4">
                                        <span class="text-gray-500 font-semibold">Discount</span>
                                        <span class="text-gray-900 font-semibold">{{ currencyFormat(discount) }}</span>
                                    </li>
                                    <li class="flex justify-between mb-4">
                                        <span class="text-gray-500 font-semibold">Taxes</span>
                                        <span class="text-gray-900 font-semibold">{{ currencyFormat(taxes) }}</span>
                                    </li>
                                </ul>
                                <div class="flex justify-between mb-4">
                                    <span class="text-gray-900 font-semibold text-lg">Total</span>
                                    <span class="text-gray-900 font-semibold text-lg">{{ currencyFormat(total) }}</span>
                                </div>
                            </div>
                            
                            <BaseButton @click="processPayment" class="py-4">Place Order</BaseButton>
                </div>
              
        
        
        
            </div>
        
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, reactive } from 'vue'
import { useForm, usePage, Link } from  '@inertiajs/inertia-vue3'
import { loadStripe } from '@stripe/stripe-js'

import CartList from '@/Shared/components/cart/MiniCart/CartList.vue'
import CartItem from '@/Shared/components/cart/MiniCart/CartItem.vue'
import FormBlock from '@/Shared/Base/FormBlock.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'

import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from '@headlessui/vue'
import axios from 'axios'


const stripe = ref(Object);
const elements = ref(null);
const cardElement = ref();
const selected = ref(props.shippingMethods[0])
const setBilling = ref(true)
const shipping = props.address.shipping
const billing = props.address.billing
const subtotal = ref(props.cart.subtotal)
const discount = ref(0)
const taxes = ref(0)

const props = defineProps({
    cart: Object,
    shippingMethods: Array,
    address : Object,
})

const currencyFormat = (amount) => {
    const sign = usePage().props.value.currency.sign;
    return `${sign} ${amount}`;
}

const calculateTotal = (params = {
        subtotal : 0,
        shipping : 0,
        taxes : 0,
        discount : 0,
    }) => {
    const { subtotal , taxes, shipping, discount } = params;
    return (subtotal + shipping + taxes) - discount;    
}

const card  = reactive({
    number: 4242424242424242,
    cvc: 123,
    exp_month: 12,
    exp_year: 23,
});


const total = ref(calculateTotal({
    subtotal: subtotal.value,
    shipping: selected.value.amount,
    taxes: taxes.value,
    discount: discount.value
}))

const processPayment = async () => {
 
    const cardElement = elements.value.getElement('card');
    const { paymentMethod , error } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: cardElement,     
        billing_details: {
            'name': email.value,
            'email': email.value,
            'address': {
                'line1': 'puro 2',
                'city': 'Allen',
                'state': 'Northern',
            }
        }
    })

    if (error) {
        
    }
    const data = {
        payment_method_id : paymentMethod.id,
        amount : total.value,
    }

    axios.post('/test', data);
}

const form = useForm({

    email: usePage().props.value.auth.user?.data.email ?? null,

    shiiping_method: selected.value,

    shipping: {
        id: shipping.id,
        firstname: shipping.firstname,
        lastname: shipping.lastname,
        street: shipping.street,
        city: shipping.city,
        region: shipping.region,
        country: shipping.country,
        postalCode: shipping.zipcode,
        phone: shipping.phone,
    },

    billing: {
        id: billing.id,
        firstname: billing.firstname,
        lastname: billing.lastname,
        street: billing.street,
        city: billing.city,
        region: billing.region,
        country: billing.country,
        postalCode: billing.zipcode,
        phone: billing.phone,
    },

    coupon_code : null,
    discount: 0,
    taxes: 0,
    total : 0,    
})
watch(selected, value => {
    if (value == null) return;

    total.value = calculateTotal({
        subtotal: subtotal.value,
        shipping: parseFloat(value.amount),
        taxes: taxes.value,
        discount : discount.value        
    }); 
   
})

onMounted(async() => {
    stripe.value = await loadStripe('pk_test_51MC08XJUyYSBVRw5Atm41Nm0kb5z12ZjUYrLB9wWVrqXQ1JKLFRo40o8zZsjUHm3OYCBVE4iYYOoX8T8C8bZkpv800tdCDVRCl');
    elements.value = stripe.value.elements();
    cardElement.value = elements.value.create('card', {
        classes: {
            base : "relative block w-full appearance-none  rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" 
        },
    })

    cardElement.value.mount('#card-element')
})

</script>