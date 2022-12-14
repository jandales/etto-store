<template>
<div class="w-full  border-b mb-12 pb-6">
    <h1 class="text-gray-900 font-semibold mb-4">{{title}}</h1>

    <div class="grid grid-cols-2 gap-4">

        <FormBlock 
            :label="'First name'"
            :type="'text'"
            :name="'firstname'" 
            v-model="form.firstname"
            @input="inputChange"
            :errors="errors.firstname"
        />

        <FormBlock 
            :label="'Last name'" 
            :type="'text'" 
            :name="'lastname'" 
            v-model="form.lastname"
            @input="inputChange"
            :errors="errors.lastname"
        />

    </div>

    <FormBlock 
        :label="'Street'"
        :type="'text'"
        :name="'street'"
        v-model="form.street"
        @input="inputChange"
        :errors="errors.street" />

    <div class="grid grid-cols-2 gap-4">

        <FormBlock 
            :label="'City'" 
            :name="'city'" 
            :type="'text'" 
            v-model="form.city"
             @input="inputChange"
            :errors="errors.city"
        />

        <FormBlock 
            :label="'Country'" 
            :name="'country'" 
            :type="'text'" 
            v-model="form.country"
             @input="inputChange"
            :errors="errors.country"
        />

    </div>

    <div class="grid grid-cols-2 gap-4">
        <FormBlock 
            :label="'Region'" 
            :type="'text'" 
            :name="'region'" 
            @input="inputChange"
            v-model="form.region"
            :errors="errors.shipping_region"
        />

        <FormBlock 
            :label="'Postal code'" 
            :type="'number'" 
            :name="'postal_code'" 
             @input="inputChange"
            v-model="form.zipcode"
            :errors="errors.zipcode"
        />

    </div>

    <FormBlock 
        :label="'Phone'" 
        :type="'text'" 
        :name="'phone'" 
         @input="inputChange"
        v-model="form.phone"
        :errors="errors.phone"
    />



</div>
</template>

<script setup>

import FormBlock from '@/Shared/Base/FormBlock.vue'


import { reactive, computed, onMounted, watch, ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default : 'Address'
    },    
    address: Object,
    errors : Object,
});

const emits = defineEmits(['updateForm']);

const form = reactive( {
    firstname: props.address.firstname,
    lastname: props.address.lastname,
    street: props.address.street,
    city: props.address.city,
    region: props.address.region,
    country: props.address.country,
    zipcode: props.address.zipcode,
    phone: props.address.phone,
})

const inputChange = () => {
    emits('updateForm', form);
}



</script>