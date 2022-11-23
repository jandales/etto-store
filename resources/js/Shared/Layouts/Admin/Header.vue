<template>
    <div class="bg-white">
        <div class="flex items-center justify-between px-3 py-4 shadow-sm">
            <div class="flex items-center gap-4">
                <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" />
                <label class="text-gray-500">Search</label>
            </div>

            <div class="flex items-center gap-4">
                <BellIcon class="w-6 h-6 text-gray-500" />
                <div class="flex -space-x-2 overflow-hidden">                   
                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                </div>
            </div>
          
        </div>
    </div>
</template>

<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
import { BellIcon } from '@heroicons/vue/24/outline';
</script>