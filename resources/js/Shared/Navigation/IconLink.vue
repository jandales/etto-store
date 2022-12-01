<template>
    <div class="ml-auto flex items-center">
        <!-- user -->
        <div class="flex items-center">
            <Link href="/account" class="text-gray-400 hover:text-gray-500">
            <UserIcon class="h-6 w-6" aria-hidden="true" />
            </Link>
        </div>
    
        <!-- Search -->
        <div class="flex lg:ml-2">
            <a href="#" @click="$emit('show', true)" class="p-2 text-gray-400 hover:text-gray-500">
                <span class="sr-only">Search</span>
                <MagnifyingGlassIcon class="h-6 w-6" aria-hidden="true" />
            </a>
        </div>
    
        <!-- Cart -->
        <div class="ml-2 flow-root lg:ml-2">
            <a href="#" @click="toggleCart(true)" class="group -m-2 flex items-center p-2">
                <ShoppingBagIcon class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ $page.props.cart_count
                }}</span>
                <span class="sr-only">items in cart, view bag</span>
            </a>
        </div>
    </div>
</template>
<script setup>

import { ref, inject } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { MagnifyingGlassIcon, ShoppingBagIcon,  UserIcon } from '@heroicons/vue/24/outline'

const { toggleCart } = inject('cart')

defineEmits(['show'])


</script>