
<template>
  <AppLayout>
    <div class="flex items-center justify-center bg-gray-500 h-80 w-full bg-[url('/public/img/shop.jpg')] bg-origin-content bg-cover bg-blend-hard-light">
          <h1 class="text-5xl text-white font-bold tracking-widest">{{selected_category}}</h1>
    </div>
    <div class="bg-white">
      <div>
        <!-- Mobile filter dialog -->
        <TransitionRoot as="template" :show="mobileFiltersOpen">
          <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
              enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
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
          <div class="relative flex items-center justify-between">
            
            <Collection 
              :categories="categories" 
              :selected="selected_category"
            />

            <MenuSort 
              :options="sortOptions"
              :title="SortTitle"
              @sort="sortBy"
             />                     
          
          </div>

          <section aria-labelledby="products-heading" class="pt-6 pb-24">
            <h2 id="products-heading" class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">     
              <!-- Product grid -->
              <div class="lg:col-span-4">
                <!-- Replace with your content -->
                <div class="mt-6  grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                  <Product v-for="product in products.data" :product="product" :key="product.id" />
                  <Observer @handler="handleLoadMoreProducts" />
                  <Spinner v-if="loadingMoreProducts" class="lg:col-span-4" />
                </div>
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
import { ref, computed, watch, defineAsyncComponent, onMounted } from 'vue'
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

import { Inertia } from '@inertiajs/inertia';
import MenuSort from '@/Shared/Shop/MenuSort.vue';
import Collection from '@/Shared/Shop/Collection.vue'

// async components
const Spinner = defineAsyncComponent(() => import('../../Shared/Loading.vue'))

const props = defineProps({
  res_products: Object,
  collections: Array,
  selected_category : String,
  sort: String,
  direction: String,
})

let products = ref(props.res_products);

const categories = computed(() => {

  let all = {
    id: 0,
    name: "All Collection",
    description: "All Collection.",
    slug: "all-collection",
    href: "/collections",
  }

  let collection = props.collections.map(item => {
    item.href = `/collections/${item.slug}`;
    return item;
  })

  return collection = [all, ...collection]

});

const sortOptions = [
  { name: 'Featured', sort: { field: 'featured', direction: 'desc' }, current: false },
  { name: 'Alphabetically: A to Z', sort: { field: 'name', direction: 'asc' }, current: false },
  { name: 'Alphabetically: Z to A', sort: { field: 'name', direction: 'desc' }, current: false },
  { name: 'Price: Low to High', sort: { field: 'regular_price', direction: 'asc' }, current: false },
  { name: 'Price: High to Low', sort: { field: 'regular_price', direction: 'desc' }, current: false },
  { name: 'Date: Old to new', sort: { field: 'created_at', direction: 'asc' }, current: false },
  { name: 'Date: New to Old', sort: { field: 'created_at', direction: 'desc' }, current: false },
]


const mobileFiltersOpen = ref(false)
const SortTitle = ref('Sort')
const loadingMoreProducts = ref(false)
const currentPageLoaded = ref(1);

let params = ref({
  sort: props.sort,
  direction: props.direction
});

const sortBy = (option) => {

  const { name, sort } = option
  SortTitle.value = name;
  params.value.sort = sort.field;

  if (sort.direction != null) {
    params.value.direction = sort.direction;
  }

}

watch(params, value => {

  Inertia.get(Inertia.page.url, value, {
    replace: true,
    preserveState: true,
    onSuccess: page => {
      products.value = page.props.res_products;
    },
  });

}, { deep: true });

const handleLoadMoreProducts = async () => {

  const { next } = products.value.links
  const { last_page, current_page } = products.value.meta;

  if (currentPageLoaded.value === last_page) return;

  loadingMoreProducts.value = true;

  await axios.get(next, { params: { ...params.value } })
    .then(res => {
      products.value = {
        ...res.data,
        data: [...products.value.data, ...res.data.data]
      }
      currentPageLoaded.value = current_page;
    }).finally(() => {
      loadingMoreProducts.value = false;
    })
}


const getSortTitle = () => {
  let id = sortOptions.findIndex(item => item.sort.field == props.sort && item.sort.direction == props.direction)
  if (id < 0) return SortTitle.value = 'Sort';
  SortTitle.value = sortOptions[id].name;
}

onMounted(getSortTitle)

</script>
