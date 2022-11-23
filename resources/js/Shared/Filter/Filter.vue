<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton
                class="inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                Filter
                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                    <FilterAction>
                        <PencilIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                        Edit
                    </FilterAction>
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                    <FilterAction>
                        <MapPinIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                        Set as Shipping Address
                    </FilterAction>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                    <FilterAction>
                        <CreditCardIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                        Set as Billing Address
                    </FilterAction>
                    </MenuItem>
                </div>

                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                    <FilterAction>
                        <TrashIcon :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" />
                        Delete
                    </FilterAction>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon, EllipsisVerticalIcon, PencilIcon, TrashIcon } from '@heroicons/vue/20/solid'
import { MapPinIcon, CreditCardIcon } from '@heroicons/vue/24/outline'
import FilterAction from './FilterAction.vue'
</script>