<template>
    <TransitionRoot as="template" :show="state">
        <Dialog as="div" class="relative z-40 lg:hidden" @close="handleClose">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
                enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>
    
            <div class="fixed inset-0 z-40 flex">
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full" enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                    leave-to="-translate-x-full">
                    <DialogPanel class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                        <div class="flex px-4 pt-5 pb-2">
                            <button type="button"
                                class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400"
                                @click="handleClose">
                                <span class="sr-only">Close menu</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>
    
    
                        <div class="space-y-6 border-t border-gray-200 py-6 px-4">
                            <div v-for="page in links.pages" :key="page.name" class="flow-root">
                                <Link :href="page.href" class="-m-2 block p-2 font-medium text-gray-900">{{ page.name }}
                                </Link>
                            </div>
                        </div>
    
                        <div class="space-y-6 border-t border-gray-200 py-6 px-4">
                            <div class="flow-root">
                                <a href="/login" class="-m-2 block p-2 font-medium text-gray-900">Sign in</a>
                            </div>
                            <div class="flow-root">
                                <a href="/register" class="-m-2 block p-2 font-medium text-gray-900">Create account</a>
                            </div>
                        </div>
    
                        <div class="border-t border-gray-200 py-6 px-4">
                            <a href="#" class="-m-2 flex items-center p-2">
                                <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt=""
                                    class="block h-auto w-5 flex-shrink-0" />
                                <span class="ml-3 block text-base font-medium text-gray-900">CAD</span>
                                <span class="sr-only">, change currency</span>
                            </a>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {  XMarkIcon } from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({
    links: Object,
    state : Boolean,     
})

const emits = defineEmits([
    'close'
])

const handleClose = () => {  
    emits('close');
}
</script>