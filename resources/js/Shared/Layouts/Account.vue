<template>
    <AppLayout>
        <PageWrapper>
            <TransitionRoot as="template" :show="open">
                <Dialog as="div" class="relative z-40 " @close="open = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                        enter-from="opacity-0" enter-to="opacity-100"
                        leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                        leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                            enter-from="-translate-x-full" enter-to="translate-x-0"
                            leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                            leave-to="-translate-x-full">
                            <DialogPanel
                                class="relative flex w-full max-w-xs flex-col overflow-y-auto bg-white pb-12 shadow-xl">
                                <div class="flex px-4 pt-5 pb-2">
                                    <button type="button"
                                        class="-m-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400"
                                        @click="open = false">
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>


                                <div class="space-y-6 border-t border-gray-200 py-6 px-4">
                                    <div v-for="page in navigation" :key="page.name" class="flow-root">
                                        <Link :href="page.href" class="-m-2 block p-2 font-medium text-gray-900">{{
                                                page.name
                                        }}</Link>
                                    </div>
                                </div>



                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <div class="flex">
                <div class="hidden lg:block lg:max-w-sm">
                    <h1 class="text-2xl font-semibold text-gray-900">My Account</h1>
                    <ul class="mt-4">
                        <li v-for="nav in navigation"
                            class="p-2 text-base rounded-md text-gray-900 hover:bg-indigo-500 hover:text-white">
                            <Link v-if="nav.name != 'Sign out'" :href="nav.href">{{ nav.name }}</Link>
                            <Link v-else href="/logout" method="post" as="button">{{ nav.name }}</Link>
                        </li>
                    </ul>
                </div>
                <div class="w-full bg-white p-4 lg:w-[calc(100%_-_200px)] lg:ml-auto">
                    <slot></slot>
                </div>
            </div>


        </PageWrapper>
    </AppLayout>

</template>     
<script setup>
import { ref, provide } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'


import AppLayout from '../Layouts/App.vue'
import PageWrapper from '../components/PageWrapper.vue'


import { XMarkIcon } from '@heroicons/vue/24/outline'
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'

const open = ref(false);

provide('menu', {
    open,
    toggle: () => open.value = true,
})

const navigation = [
    { name: 'My Profile', href: '/account' },
    { name: 'My Orders', href: '/account/orders' },
    { name: 'My Address', href: '/account/address' },
    { name: 'Sign out', href: '/logout' },
]
</script>