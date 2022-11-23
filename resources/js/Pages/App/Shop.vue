
<template>
  <AppLayout>
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
                      <li v-for="category in collection" :key="category.name">
                        <a href="#" class="block px-2 py-3">{{ category.name }}</a>
                      </li>
                    </ul>

                    <Disclosure as="div" v-for="section in filters" :key="section.id"
                      class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                      <h3 class="-mx-2 -my-3 flow-root">
                        <DisclosureButton
                          class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                          <span class="font-medium text-gray-900">{{ section.name }}</span>
                          <span class="ml-6 flex items-center">
                            <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                            <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                          </span>
                        </DisclosureButton>
                      </h3>
                      <DisclosurePanel class="pt-6">
                        <div class="space-y-6">
                          <div v-for="(option, optionIdx) in section.options" :key="option.value"
                            class="flex items-center">
                            <input :id="`filter-mobile-${section.id}-${optionIdx}`" :name="`${section.id}[]`"
                              :value="option.value" type="checkbox" :checked="option.checked"
                              class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                            <label :for="`filter-mobile-${section.id}-${optionIdx}`"
                              class="ml-3 min-w-0 flex-1 text-gray-500">{{ option.label }}</label>
                          </div>
                        </div>
                      </DisclosurePanel>
                    </Disclosure>
                  </form>
                </DialogPanel>
              </TransitionChild>
            </div>
          </Dialog>
        </TransitionRoot>

        <PageWrapper>
          <div class="flex items-baseline justify-between border-b border-gray-200  pb-6">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 capitalize">{{ selected_category }}</h1>

            <div class="flex items-center">
              <Menu as="div" class="relative inline-block text-left">
                <div>
                  <MenuButton
                    class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    {{ SortTitle }}
                    <ChevronDownIcon class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                      aria-hidden="true" />
                  </MenuButton>
                </div>

                <transition enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95">
                  <MenuItems
                    class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1">
                      <MenuItem v-for="option in sortOptions" :key="option.name" v-slot="{ active }">
                      <span @click="sortBy(option)"
                        :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']">
                        {{
                            option.name
                        }}</span>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>

              <!-- <button type="button" class="-m-2 ml-5 p-2 text-gray-400 hover:text-gray-500 sm:ml-7">
                <span class="sr-only">View grid</span>
                <Squares2X2Icon class="h-5 w-5" aria-hidden="true" />
              </button>
              <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                @click="mobileFiltersOpen = true">
                <span class="sr-only">Filters</span>
                <FunnelIcon class="h-5 w-5" aria-hidden="true" />
              </button> -->
            </div>
          </div>

          <section aria-labelledby="products-heading" class="pt-6 pb-24">
            <h2 id="products-heading" class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
              <!-- Filters -->
              <form class="hidden lg:block">
                <h3 class="sr-only">Categories</h3>
                <ul role="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">
                  <li v-for="category in categories" :key="category.id">
                    <Link :href="category.href">{{ category.name }}</Link>
                  </li>
                </ul>

                <Disclosure as="div" v-for="section in filters" :key="section.id" class="border-b border-gray-200 py-6"
                  v-slot="{ open }">
                  <h3 class="-my-3 flow-root">
                    <DisclosureButton
                      class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                      <span class="font-medium text-gray-900">{{ section.name }}</span>
                      <span class="ml-6 flex items-center">
                        <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                        <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                      </span>
                    </DisclosureButton>
                  </h3>
                  <DisclosurePanel class="pt-6">
                    <div class="space-y-4">
                      <div v-for="(option, optionIdx) in section.options" :key="option.value" class="flex items-center">
                        <input :id="`filter-${section.id}-${optionIdx}`" :name="`${section.id}[]`" :value="option.value"
                          type="checkbox" :checked="option.checked"
                          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                        <label :for="`filter-${section.id}-${optionIdx}`" class="ml-3 text-sm text-gray-600">{{
                            option.label
                        }}</label>
                      </div>
                    </div>
                  </DisclosurePanel>
                </Disclosure>
              </form>

              <!-- Product grid -->
              <div class="lg:col-span-3">
                <!-- Replace with your content -->
                <div class="mt-6  grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                  <Product v-for="product in products.data" :product="product" :key="product.id" />
                  <Observer @handler="handleLoadMoreProducts" />
                  <Spinner v-if="loadingMoreProducts" />
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
import { Link } from '@inertiajs/inertia-vue3'
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
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from '@headlessui/vue'

// icons
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, MinusIcon, PlusIcon } from '@heroicons/vue/20/solid'
import { Inertia } from '@inertiajs/inertia';

// async components
const Spinner = defineAsyncComponent(() => import('../../Shared/Loading.vue'))

const props = defineProps({
  res_products: Object,
  collections: Array,
  selected_category: String,
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


const filters = [
  {
    id: 'color',
    name: 'Color',
    options: [
      { value: 'white', label: 'White', checked: false },
      { value: 'beige', label: 'Beige', checked: false },
      { value: 'blue', label: 'Blue', checked: true },
      { value: 'brown', label: 'Brown', checked: false },
      { value: 'green', label: 'Green', checked: false },
      { value: 'purple', label: 'Purple', checked: false },
    ],
  },
  {
    id: 'category',
    name: 'Category',
    options: [
      { value: 'new-arrivals', label: 'New Arrivals', checked: false },
      { value: 'sale', label: 'Sale', checked: false },
      { value: 'travel', label: 'Travel', checked: true },
      { value: 'organization', label: 'Organization', checked: false },
      { value: 'accessories', label: 'Accessories', checked: false },
    ],
  },
  {
    id: 'size',
    name: 'Size',
    options: [
      { value: '2l', label: '2L', checked: false },
      { value: '6l', label: '6L', checked: false },
      { value: '12l', label: '12L', checked: false },
      { value: '18l', label: '18L', checked: false },
      { value: '20l', label: '20L', checked: false },
      { value: '40l', label: '40L', checked: true },
    ],
  },
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
