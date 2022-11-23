<template>
    <AccountPageHeading :title="title">
        <template #action>
            <a href="/account/address/create" class="hidden lg:flex ml-auto items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Add new address</a>
        </template>
        <p class="text-gray-500 mt-2">Manage  your shipping and billing address </p>
    </AccountPageHeading>

  
   
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
                    {{ address.name }}
                </td>
                <td class="text-left capitalize p-4 text-sm text-gray-500">{{ address.phone }}</td>
                <td class="text-left capitalize  capitalizep-4 text-sm text-gray-500">{{ address.address }}</td>  
                <td class="text-center p-4 text-sm text-gray-500">
                    <ul class="flex flex-col gap-2">
                        <li v-if="address.isBilling"  class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">DEFAULT SHIPPING</li>
                        <li v-if="address.isShipping" class="flex justify-center px-2 py-1 rounded-md bg-indigo-400 text-white">DEFAULT BILLING</li>
                    </ul>
                </td>   
                     
                <td class="p-4 flex gap-4 items-center justify-end text-right">
                    <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
        Action
        <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
      </MenuButton>
    </div>

    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="/account/address/edit" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit</a>
          </MenuItem>      
        </div>
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Set as Shipping Address</a>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Set as Billing Address</a>
          </MenuItem>
        </div>
       
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Delete</a>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>         
                </td>                             
            </tr>           
        </tbody>        
    </table>
    </div>
    <!-- Mobile view-->
    <div class="lg:hidden">

      <div v-for="address in addresses" class="w-full bg-gray-200 mt-4 px-4 py-3 rounded">
        <div class="flex items-center">
            <span class="capitalize text-gray-700">{{ address.name }}</span>
            <div class="border-r border-gray-900 px-2"></div>
            <span class="text-gray-700 ml-2">{{ address.phone }}</span>            
        </div>
        <label for="" class="capitalize text-gray-700">{{ address.street }}</label>
        <label for="" class="capitalize text-gray-700">
         {{ `${address.barangay} ${address.city} ${address.province}, ${address.zipcode}` }}
        </label>
        <div class="mt-2 flex items-center gap-4">
          <span v-if="address.isBilling" class="flex p-2 rounded-md bg-indigo-400 text-white"  > 
                Default Billing
            </span>
            <span v-if="address.isShipping" class="flex p-2 rounded-md bg-indigo-400 text-white">
                Default Shipping
            </span>
            <span class="ml-auto">
              <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton>
        <EllipsisVerticalIcon class="ml-2 h-5 w-5" aria-hidden="true" />      
      </MenuButton>
    </div>

    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit</a>
          </MenuItem>      
        </div>
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Set as Shipping Address</a>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Set as Billing Address</a>
          </MenuItem>
        </div>
       
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Delete</a>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu> 
            </span>
        </div>
      </div>

      <div class="mt-4">
        <a href="/account/address/create" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Add new address</a>
      </div>



    </div>
   
 
   
</template>
<script setup>
import AccountPageHeading from '../../AccountPageHeading.vue'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon, EllipsisVerticalIcon } from '@heroicons/vue/20/solid'
const title = 'Addresses'
const addresses = [
    { 
      label : 'home', 
      name : 'jesus andales', 
      phone : '095648451548',
      street : 'purok 2',
      barangay : 'brgy. lagundi',
      city : 'Allen ',
      province :  'Norther Samar',
      zipcode : '2123',
      address  : 'purok 2 brgy. lagundi allen Norther Samar, 2123', 
      isShipping : 1, 
      isBilling : 0 
    },
    { 
      label : 'office', 
      name : 'jess andales',  
      phone : '095648424243', 
      street : '45F, Aggoncillo',
      barangay : 'Santa Lucia',
      city : 'Nocaliches',
      province :  'QC',
      zipcode : '1117',
      address  : '45F, Aggoncillo Santa Lucia Nocaliches QC, 1117', 
      isShipping : 0, 
      isBilling : 1
   }
]
</script>