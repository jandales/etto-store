

<template>
  <AccountLayout>
    <Alert v-if="status.success" :alert="'success'" :message="status.message" @close="status.success = false" />
    <AccountPageHeading :title="title">
      <template #action>
        <Link href="/account/address/create"
          class="hidden lg:flex ml-auto items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
        Add
        new address</Link>
      </template>
      <p class="text-gray-500 mt-2">Manage your shipping and billing address </p>
    </AccountPageHeading>


    {{ active }}
    <!-- Destop view-->
    <div class="hidden lg:block">
      <table class="table-fixed border w-full mt-8 rounded-md ">
        <thead>
          <tr class="border-b">
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
              {{ `${address.firstname} ${address.lastname} ` }}
            </td>
            <td class="text-left capitalize p-4 text-sm text-gray-500">{{ address.phone }}</td>
            <td class="text-left capitalize  capitalizep-4 text-sm text-gray-500">{{ `${address.street}
                          ${address.barangay} ${address.city} ${address.province}, ${address.zipcode}`
            }}</td>
            <td class="text-center p-4 text-sm text-gray-500">
              <ul class="flex flex-col gap-2">
                <li v-if="address.shipping" class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">
                  Shipping</li>
                <li v-if="address.billing" class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">
                  Billing</li>
              </ul>
            </td>

            <td class="p-4 flex gap-4 items-center justify-end text-right">
              <MenuList>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                  <Link :href="`/account/address/edit/${address.id}`"
                    :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'flex px-4 py-2 text-sm']">
                  <PencilIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                  Edit
                  </Link>
                  </MenuItem>
                </div>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                  <MenuAction @click="handleSetShipping(address.id)">
                    <MapPinIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                    Set as Shipping Address
                  </MenuAction>
                  </MenuItem>
                </div>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                  <MenuAction @click="handleSetBilling(address.id)">
                    <CreditCardIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                    Set as Billing Address
                  </MenuAction>
                  </MenuItem>
                </div>
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                  <MenuAction @click="handleDelete(address.id)">
                    <TrashIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                    Delete
                  </MenuAction>
                  </MenuItem>
                </div>
              </MenuList>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Mobile view-->
    <div class="lg:hidden">

      <div v-for="address in addresses" class="w-full bg-gray-200 mt-4 px-4 py-3 rounded">

        <div class="flex items-center">
          <span class="capitalize text-gray-700">{{ `${address.firstname} " " ${address.lastname} ` }}</span>
          <div class="border-r border-gray-900 px-2"></div>
          <span class="text-gray-700 ml-2">{{ address.phone }}</span>
        </div>
        <label for="" class="capitalize text-gray-700">{{ address.street }}</label>
        <label for="" class="capitalize text-gray-700">
          {{ `${address.barangay} ${address.city} ${address.province}, ${address.zipcode}` }}
        </label>
        <div class="mt-2 flex items-center gap-4">
          <span v-if="address.billing" class="flex p-2 rounded-md bg-indigo-400 text-white">
            Default Billing
          </span>
          <span v-if="address.shipping" class="flex p-2 rounded-md bg-indigo-400 text-white">
            Default Shipping
          </span>
          <span class="ml-auto">
            <MenuList />
          </span>
        </div>
      </div>

      <div class="mt-4">
        <a href="/account/address/create"
          class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Add
          new address</a>
      </div>



    </div>

  </AccountLayout>

</template>
<script setup>

import { defineAsyncComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'

import AccountLayout from '@/Shared/Layouts/Account.vue'
import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue'
import MenuList from '@/Shared/Menu/MenuList.vue'
import MenuAction from '@/Shared/Menu/MenuAction.vue'

import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { PencilIcon, TrashIcon } from '@heroicons/vue/20/solid'
import { MapPinIcon, CreditCardIcon } from '@heroicons/vue/24/outline'

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'));

const title = 'Addresses'

defineProps({
  addresses: {
    type: Array,
    default: [],
  },
  status: {
    type: Object,
    default: {
      success: false,
      error: false,
      message: null,
    },
  }

})

const handleSetShipping = (id) => {
  Inertia.put(`/account/address/${id}/setShipping`);
}

const handleSetBilling = (id) => {
  Inertia.put(`/account/address/${id}/setBilling`);
}

const handleDelete = (id) => {
  Inertia.delete(`/account/address/${id}/destroy`);
}


</script>