<template>
    <Layout>

        <PagHeading :title="title">
            <a href="#"
                class="rounded-md border border-transparent text-sm bg-indigo-600 py-2 px-6 text-right font-medium text-white hover:bg-indigo-700">Create
                Create Product</a>
        </PagHeading>

        <FilterWrapper>
            <div>
                <BaseSearch />
            </div>
            <div class="ml-auto">
                <Filter />
            </div>
        </FilterWrapper>


        <div class="">
            <TableLayout>
                <template #head>
                    <TableTr class="border-b rounded-md">
                        <TableTH class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Name</TableTH>
                        <TableTH class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Phone Number
                        </TableTH>
                        <TableTH class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100">Address</TableTH>
                        <TableTH class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100"></TableTH>
                        <TableTH class="text-left p-4 text-sm text-gray-500 font-normal bg-gray-100"></TableTH>
                    </TableTr>
                </template>
                <template #body>
                    <TableTr v-for="address in addresses" class="border-b">
                        <TableTd class="text-left  capitalize p-4 text-sm text-gray-500">
                            {{ address.name }}
                        </TableTd>
                        <TableTd class="text-left capitalize p-4 text-sm text-gray-500">
                            {{ address.phone }}
                        </TableTd>
                        <TableTd class="text-left capitalize  capitalizep-4 text-sm text-gray-500">
                            {{ address.address }}</TableTd>
                        <TableTd class="text-center p-4 text-sm text-gray-500">
                        </TableTd>
                        <TableTd class="p-4 flex gap-4 items-center justify-end text-right">
                        </TableTd>
                    </TableTr>
                </template>
            </TableLayout>
        </div>
        <Pagination />
    </Layout>
</template>

<script setup>
import Layout from '../../Shared/Layouts/Admin/Layout.vue'
import TableLayout from '../../Shared/Table/TableLayout.vue';
import TableTr from '../../Shared/Table/TableTr.vue';
import TableTH from '../../Shared/Table/TableTH.vue';
import TableTd from '../../Shared/Table/TableTd.vue';
import Pagination from '../../Shared/Pagination/Pagination.vue';
import BaseSearch from '../../Shared/Base/BaseSearch.vue'
import Filter from '../../Shared/Filter/Filter.vue'
import PagHeading from '../../Shared/Layouts/Admin/PagHeading.vue';
import FilterWrapper from '../../Shared/Filter/FilterWrapper.vue';

const title = 'Products'
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
