
<template>
  <div class="bg-white">
    <!-- Mobile menu -->
    <MobileDrawer :links="navigation" :state="open" @close="open = false" />   
   
    <header class="relative bg-white">
      <TextContent :type="'p'"
        class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8">
        Get free delivery on orders over $100
      </TextContent>
      <!-- max-w-7xl px-4 sm:px-6 lg:px-8 -->
      <nav aria-label="Top" class="w-full px-4 sm:px-6 lg:px-0">
        <div class="border-b w-full border-gray-200">
          <div class="flex max-w-7xl mx-auto h-16 items-center">

           <Hamburger @open="open = true" />

            <!-- Logo -->
            <Logo />
            <!-- Flyout menus -->
            <Links :links="navigation" />
            
            <IconLink />
          
          </div>
        </div>
      </nav>
    </header>
  </div>
  <slot></slot>
</template>

<script setup>
import { ref } from 'vue'

import TextContent from '@/Shared/TextContext'

import Hamburger from '@/Shared/Navigation/Hamburger.vue'
import Logo from '@/Shared/Navigation/Logo.vue'
import MobileDrawer from '@/Shared/Navigation/MobileDrawer.vue'
import Links from '@/Shared/Navigation/Links.vue'
import IconLink from '@/Shared/Navigation/IconLink.vue';



const open = ref(false)

const navigation = {
  pages: [
    { name: 'Home', href: '/' },
    { name: 'Shop', href: '/collections' },
    { name: 'Contact', href: '/contact' },
    { name: 'Cart', href: '/cart' },
  ]
}
</script>
