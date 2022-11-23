<template>
    <Layout>

        <PagHeading :title="title" />

        <ul class="flex gap-10 mt-6 border-b">
            <li
                :class="[pendingTab ? 'border-b-indigo-500 text-gray-9npm00' : 'border-b-transparent text-gray-500', 'border-b-4 py-4 cursor-pointer']">
                Pending
            </li>
            <li class="border-b-4 py-4 cursor-pointer  border-b-transparent text-gray-500">
                Confirmed
            </li>
            <li class="border-b-4 py-4 cursor-pointer border-b-transparent text-gray-500">
                Shipped
            </li>
            <li class="border-b-4 py-4 cursor-pointer border-b-transparent text-gray-500">
                Delivered
            </li>
        </ul>


        <FilterWrapper>
            <div>
                <BaseSearch />
            </div>
            <div class="ml-auto">
                <Filter />
            </div>
        </FilterWrapper>


        <div class="">
            <table class="table-fixed border w-full mt-8 rounded-md bg-white shadow">
                <thead>
                    <tr class="border-b rounded-md">
                        <th class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Name</th>
                        <th class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Phone Number</th>
                        <th class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Address</th>
                        <th class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100"></th>
                        <th class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="address in addresses" class="border-b">
                        <td class="text-left  capitalize p-4 text-sm text-gray-500">
                            {{ address.name }}
                        </td>
                        <td class="text-left capitalize p-4 text-sm text-gray-500">{{ address.phone }}</td>
                        <td class="text-left capitalize  capitalizep-4 text-sm text-gray-500">{{ address.address }}</td>
                        <td class="text-center p-4 text-sm text-gray-500">
                            <ul class="flex flex-col gap-2">
                                <li v-if="address.isBilling"
                                    class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">DEFAULT
                                    SHIPPING</li>
                                <li v-if="address.isShipping"
                                    class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">DEFAULT
                                    BILLING</li>
                            </ul>
                        </td>

                        <td class="p-4 flex gap-4 items-center justify-end text-right">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination />

    </Layout>
</template>

<script setup>
import Layout from '../../Shared/Layouts/Admin/Layout.vue'
import Pagination from '../../Shared/Pagination/Pagination.vue';
import BaseSearch from '../../Shared/Base/BaseSearch.vue'
import Filter from '../../Shared/Filter/Filter.vue'
import PagHeading from '../../Shared/Layouts/Admin/PagHeading.vue';
import FilterWrapper from '../../Shared/Filter/FilterWrapper.vue';
const title = 'Orders'
const pendingTab = true;
const addresses = [
    {
        label: 'home',
        name: 'jesus andales',
        phone: '095648451548',
        street: 'purok 2',
        barangay: 'brgy. lagundi',
        city: 'Allen ',
        province: 'Norther Samar',
        zipcode: '2123',
        address: 'purok 2 brgy. lagundi allen Norther Samar, 2123',
        isShipping: 1,
        isBilling: 0
    },
    {
        label: 'office',
        name: 'jess andales',
        phone: '095648424243',
        street: '45F, Aggoncillo',
        barangay: 'Santa Lucia',
        city: 'Nocaliches',
        province: 'QC',
        zipcode: '1117',
        address: '45F, Aggoncillo Santa Lucia Nocaliches QC, 1117',
        isShipping: 0,
        isBilling: 1
    }
]


</script>
