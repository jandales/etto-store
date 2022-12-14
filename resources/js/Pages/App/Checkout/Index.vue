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
                    
                    <a :href="paymentPaypalLink" class="bg-indigo-500 text-white py-2 block text-center rounded-md hover:bg-indigo-600">Paypal</a>

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
                    
                    <FormBlock 
                        :label="'Email'" 
                        :type="'email'" 
                        :name="'email'" 
                        v-model="form.email"
                        :errors="errors.email"
                      />

                </div> 

                <AddressForm 
                    :title="'Shipping Information'"
                    :address="shippingForm"
                    @updateForm="updateShippingForm"
                    :errors="{
                        firstname: errors.shipping_firstname,
                        lastname: errors.shipping_lastname,
                        street: errors.shipping_street,
                        city: errors.shipping_city,
                        region: errors.shipping_region,
                        country: errors.shipping_country,
                        zipcode: errors.shipping_zipcode,
                        phone: errors.shipping_phone,
                    }"              
                />

                <ShippingMethodVue 
                    :shippingMethods="shippingMethods" 
                    @updateOption="updateShippingMethod"
                />

                <div class="w-full  border-b mb-12 pb-6">
                    <h1 class="text-gray-900 font-semibold mb-4">Payment</h1>
                    <div id="card-element">
                    </div>
                </div>

                <div class="mb-4">
                    <input type="checkbox" v-model="form.same_as_shipping" name="billing" id="billing" checked class="mr-2">
                    <label for="">Billing address is the same as shipping address</label>
                </div>


                <BillingAddressForm v-if="!form.same_as_shipping"
                    :title="'Billing Information'"                    
                    :address="{
                        firstname: form.billing_firstname,
                        lastname: form.billing_lastname,
                        street: form.billing_street,
                        city: form.billing_city,
                        region: form.billing_region,
                        country: form.billing_country,
                        zipcode: form.billing_zipcode,
                        phone: form.billing_phone,
                    }"

                    @updateForm="updateBillingForm"

                    :errors="{
                        firstname: errors.shipping_firstname,
                        lastname: errors.shipping_lastname,
                        street: errors.shipping_street,
                        city: errors.shipping_city,
                        region: errors.shipping_region,
                        country: errors.shipping_country,
                        zipcode: errors.shipping_zipcode,
                        phone: errors.shipping_phone,
                    }"
                 />              
                        
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
                            
                            <BaseButton @click="processPayment" class="py-4">
                                <ClipLoader v-if="isProccessing" :color="'#fff'" :size="'16px'"  />
                                <label v-else>Place Order</label>                                
                            </BaseButton>

                </div>
              
        
        
        
            </div>
        
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, reactive, defineAsyncComponent } from 'vue'
import { useForm, usePage, Link, } from  '@inertiajs/inertia-vue3'
import { loadStripe } from '@stripe/stripe-js'

import CartList from '@/Shared/components/cart/MiniCart/CartList.vue'
import CartItem from '@/Shared/components/cart/MiniCart/CartItem.vue'
import FormBlock from '@/Shared/Base/FormBlock.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'
import AddressForm from '@/Shared/Checkout/AddressForm.vue'
import ShippingMethodVue from '@/Shared/Checkout/ShippingMethod.vue'

import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from '@headlessui/vue'
import axios from 'axios'
import { Inertia } from '@inertiajs/inertia'

const ClipLoader = defineAsyncComponent(() => import('vue-spinner/src/ClipLoader.vue'));
const BillingAddressForm = defineAsyncComponent(() => import('@/Shared/Checkout/AddressForm.vue'));


const stripe = ref(Object);
const elements = ref(null);
const cardElement = ref();
const selected = ref(props.shippingMethods[0])
const shipping = props.address.shipping
const billing = props.address.billing
const subtotal = ref(props.cart.subtotal)
const discount = ref(0)
const taxes = ref(0)
const errors = ref([]);
const isProccessing = ref(false);


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

const updateShippingMethod = (value) => {
    selected.value = value;
}

const total = ref(calculateTotal({
    subtotal: subtotal.value,
    shipping: selected.value.amount,
    taxes: taxes.value,
    discount: discount.value
}))



const processPayment = async () => {

    const cardElement = elements.value.getElement('card');
    const { paymentMethod, error } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: cardElement, 
        'billing_details': {
            'email': form.email,
            'name': `${form.firstname} ${form.lastname}`
        }      
    })

    if (error) {
        console.log(error);
        return;
    }

    form.payment_method_id = paymentMethod.id;
    form.amount = total.value

    try {
        isProccessing.value = true;
        const response = await axios.post('/checkout/payment', form);
        const { url, success } = response.data
        if (success == true)   {
             window.location = url   
        }
    } catch (err) {
        errors.value = err.response.data.errors;
        console.log(errors.value.shipping_lastname);
    } finally {
        isProccessing.value = false;
    }
   
   
}

const form = useForm({
    email: usePage().props.value.auth.user?.data.email ?? null,
    shipping_method: selected.value,   
    shipping_id: shipping.id,
    coupon_code: null,
    discount: 0,
    taxes: 0,
    total: 0,
    coupon_code : null,
    shipping_firstname: shipping.firstname,
    shipping_lastname: shipping.lastname,
    shipping_street: shipping.street,
    shipping_city: shipping.city,
    shipping_region: shipping.region,
    shipping_country: shipping.country,
    shipping_zipcode: shipping.zipcode,
    shipping_phone: shipping.phone,

    billing_id: billing.id,
    billing_firstname: billing.firstname,
    billing_lastname: billing.lastname,
    billing_street: billing.street,
    billing_city: billing.city,
    billing_region: billing.region,
    billing_country: billing.country,
    billing_zipcode: billing.zipcode,
    billing_phone: billing.phone,    
    same_as_shipping : true,
})


const shippingForm = {
    firstname: shipping.firstname,
    lastname: shipping.lastname,
    street: shipping.street,
    city: shipping.city,
    region: shipping.region,
    country: shipping.country,
    zipcode: shipping.zipcode,
    phone: shipping.phone,
}

const updateShippingForm = (data) => { 
    form.shipping_firstname = data.firstname;  
    form.shipping_lastname = data.lastname;
    form.shipping_street = data.street;
    form.shipping_city = data.city;
    form.shipping_region = data.region;
    form.shipping_country = data.country;
    form.shipping_zipcode = data.zipcode;
    form.shipping_phone = data.phone;
}

const updateBillingForm = (data) => {
    form.billing_firstname = data.firstname;
    form.billing_lastname = data.lastname;
    form.billing_street = data.street;
    form.billing_city = data.city;
    form.billing_region = data.region;
    form.billing_country = data.country;
    form.billing_zipcode = data.zipcode;
    form.billing_phone = data.phone;
}







const paymentPaypalLink = ref(`/checkout/payment/paypal/proccess?email=${form.email}&amount=${total.value}&currency=PHP&shipping_method_id=${selected.value.id}&shipping_amount=${selected.value.amount}&discount=${form.discount}&taxes=${form.taxes}&coupon_code${form.coupon_code}`)


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



const paypal = () => {
    
    Inertia.post('/checkout/payment/paypal/proccess', form);
}

</script>