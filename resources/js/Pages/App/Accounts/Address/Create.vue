<template>
    <AccountLayout>


        <AccountPageHeading :title="title"></AccountPageHeading>

        <form @submit.prevent="handleCreateAddress" method="post" class="flex flex-col mt-8 lg:flex-row lg:gap-8">
            <div class="w-full lg:w-1/2">
                <div class="rounded-md shadow-sm">
                    <h2 class="block text-lg text-gray-900 font-semibold mb-4">Contact Information</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <FormBlock v-model="form.firstname" :label="'Firstname'" :name="'firstname'" :type="'text'"
                            :placeholder="'Firstname'" :errors="form.errors.firstname" />
                        <FormBlock v-model="form.lastname" :label="'Last name'" :name="'lastname'" :type="'text'"
                            :placeholder="'Lastname'" :errors="form.errors.lastname" />
                    </div>


                    <FormBlock v-model="form.phone" :label="'Phone'" :name="'phone'" :type="'tel'"
                        :placeholder="'Phone Number'" :errors="form.errors.phone" />

                </div>

            </div>
            <div class="w-full lg:w-1/2">


                <h2 class="block text-lg text-gray-900 font-semibold mb-4">Address</h2>

                <FormBlock v-model="form.street" :label="'Street'" :name="'street'" :type="'text'"
                    :placeholder="'Street'" :errors="form.errors.street" />


                <FormBlock v-model="form.city" :label="'City'" :name="'city'" :type="'text'" :placeholder="'City'"
                    :errors="form.errors.city" />

                <FormBlock v-model="form.region" :label="'Region'" :name="'region'" :type="'text'" :placeholder="'City'"
                    :errors="form.errors.region" />

                <FormBlock v-model="form.country" :label="'Country'" :name="'country'" :type="'text'"
                    :placeholder="'Country'" :errors="form.errors.country" />

                <FormBlock v-model="form.zipcode" :label="'Zipcode'" :name="'zipcode'" :type="'text'"
                    :placeholder="'Zipcode'" :errors="form.errors.zipcode" />


                <BaseButton class="lg:w-16">
                    Save
                </BaseButton>


            </div>
        </form>

    </AccountLayout>


</template>

<script setup>

import { useForm } from '@inertiajs/inertia-vue3'

import AccountLayout from '@/Shared/Layouts/Account.vue'

import BaseButton from "@/Shared/base/BaseButton.vue"
import FormBlock from '@/Shared/base/FormBlock.vue'
import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue'

const title = 'Add new Address'

const form = useForm({
    firstname: null,
    lastname: null,
    street: null,
    city: null,
    phone: null,
    country: null,
    region: null,
    zipcode: null,
})

const handleCreateAddress = () => {
    form.post('/account/address/store');
}


</script>