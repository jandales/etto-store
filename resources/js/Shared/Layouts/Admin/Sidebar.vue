<script setup>
import { HomeIcon, InboxIcon, ClipboardDocumentIcon, UsersIcon } from '@heroicons/vue/24/outline';
</script>
<template>
    <div class="hidden max-w-md bg-gray-800 min-h-screen px-2 lg:block">
        <div class="w-full flex flex-col flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center py-4 px-2">
            <img class="block h-8 w-auto lg:hidden" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
            <img class="hidden h-8 w-auto lg:block" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
        </div>
        <div class="hidden sm:ml-6 sm:block lg:ml-0">
            <div class="flex flex-col gap-2">
            <a  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 flex gap-2 items-center rounded-md text-sm font-medium cursor-pointer">
                <HomeIcon class="h-6 w-6"/>
                Dashboard
            </a>
            <a  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 flex gap-2 items-center rounded-md text-sm font-medium cursor-pointer">
                <InboxIcon class="h-6 w-6"/>
                Products
            </a>
            <a  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 flex gap-2 items-center rounded-md text-sm font-medium cursor-pointer">
                <ClipboardDocumentIcon  class="h-6 w-6"/>
                Orders
            </a>
            <a  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 flex gap-2 items-center rounded-md text-sm font-medium cursor-pointer">
                <UsersIcon class="h-6 w-6"/>
                Customers
            </a>
            </div>
        </div>
        </div>
    </div>
</template>