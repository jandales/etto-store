
<template>
    <AppLayout>
        <div
            class="flex items-center justify-center bg-gray-500 h-80 w-full bg-[url('/public/img/shop.jpg')] bg-origin-content bg-cover bg-blend-hard-light">
            <h1 class="text-5xl text-white font-bold tracking-widest">Search</h1>
        </div>
        <div class="bg-white">
            <div>
                <!-- Mobile filter dialog -->
                <TransitionRoot as="template" :show="mobileFiltersOpen">
                    <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                            enter-from="opacity-0" enter-to="opacity-100"
                            leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                            leave-to="opacity-0">
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-40 flex">
                            <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                enter-from="translate-x-full" enter-to="translate-x-0"
                                leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                leave-to="translate-x-full">
                                <DialogPanel
                                    class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                    <div class="flex items-center justify-between px-4">
                                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                                        <button type="button"
                                            class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                            @click="mobileFiltersOpen = false">
                                            <span class="sr-only">Close menu</span>
                                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                        </button>
                                    </div>

                                    <!-- Filters -->
                                    <form class="mt-4 border-t border-gray-200">
                                        <h3 class="sr-only">Categories</h3>
                                        <ul role="list" class="px-2 py-3 font-medium text-gray-900">
                                            <li v-for="category in categories" :key="category.name">
                                                <a href="#" class="block px-2 py-3">{{ category.name }}</a>
                                            </li>
                                        </ul>


                                    </form>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </Dialog>
                </TransitionRoot>

                <PageWrapper>
                 
                    <nav aria-label="Breadcrumb">
                        <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                            <li>
                                <div class="flex items-center">
                                    <Link href="/" class="mr-2 text-sm font-medium text-gray-900">Home</Link>                                  
                                    <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true" class="h-5 w-4 text-gray-300">
                                        <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                    </svg>
                                </div>
                            </li>
                            <li class="text-sm">
                                <a  aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">Search: {{ products.data.length }} results found for "{{props.keyword}}"</a>
                            </li>
                        </ol>
                    </nav>

                    <h1 class="block text-center text-3xl font-semibold py-8">Search </h1> 

                    <BaseSearch v-model="keyword" @keydown.enter="handleSearch" @clear="keyword = null" />

                    <section aria-labelledby="products-heading" class="pt-6 pb-24">
                        <h2 id="products-heading" class="sr-only">Products</h2>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                            <!-- Product grid -->
                            <div class="lg:col-span-4">
                                <!-- Replace with your content -->
                                <div
                                v-if="products.data.length > 0"
                                    class="mt-6  grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                                    <Product v-for="product in products.data" :product="product" :key="product.id" />
                                    <!-- <Observer @handler="handleLoadMoreProducts" /> -->
                                    <Spinner v-if="loadingMoreProducts" class="lg:col-span-4" />
                                </div>
                                <p v-else class="mt-4 text-gray-500">
                                    Your search for "{{props.keyword}}" did not yield any results.
                                </p>
                                <!-- /End replace -->
                            </div>
                        </div>
                    </section>
                </PageWrapper>
            </div>
        </div>
    </AppLayout>

</template>
  
<script setup>
import { ref, defineAsyncComponent, watch,  } from 'vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import axios from 'axios';
// components
import AppLayout from '@/Shared/Layouts/App.vue';
import Product from '@/Shared/components/shop/Product.vue'
import PageWrapper from '@/Shared/components/PageWrapper.vue'
import Observer from '@/Shared/Observer.vue';
// components @headkess ui
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
// icons
import { XMarkIcon } from '@heroicons/vue/24/outline'
import BaseSearch from '@/Shared/Base/BaseSearch.vue';
import { debounce } from 'lodash';
// async components
const Spinner = defineAsyncComponent(() => import('../../Shared/Loading.vue'))

const props = defineProps({
    products: Object,   
    keyword : String,
})

const mobileFiltersOpen = ref(false)
const loadingMoreProducts = ref(false)
const keyword = ref();

const handleSearch = () => {
    Inertia.get(`/search?keyword=${keyword.value}`, {}, { preserveState: true, replace: true });
}

</script>
