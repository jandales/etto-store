<template>

<AppLayout>
  <div class="p-4">
    <Alert v-if="status.error" :alert="'error'" :message="status.message"  @close="status.error= false" />
    <Alert v-if="status.success" :alert="'success'" :message="status.message" @close="status.success = false"/>
  </div>
  <div class="bg-white">
    <div class="pt-6">   
      <nav aria-label="Breadcrumb">
        <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
          <li v-for="breadcrumb in product.breadcrumbs" :key="breadcrumb.id">
            <div class="flex items-center">
              <a :href="breadcrumb.href" class="mr-2 text-sm font-medium text-gray-900">{{ breadcrumb.name }}</a>
              <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-4 text-gray-300">
                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
              </svg>
            </div>
          </li>
          <li class="text-sm">
            <a :href="product.href" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ product.name }}</a>
          </li>
        </ol>
      </nav>   

      <!-- Product info -->
      <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
        <div class="lg:col-span-1  lg:pr-8">
            <!-- <ProductImageGallary :image="product.images[0]" /> -->
            <div class="flex flex-wrap">
                  <div v-for="image in product.images" class="w-1/2 aspect-square">
                    <img :src="image.src" :alt="image.alt" class="w-full h-full object-cover object-center"> 
                  </div>
            </div>

       
         
        </div>  
        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">           
          <ProductTitle :product="product" /> 
          <!-- Reviews -->
          <ProductReviews :reviews="{ href: '#', average: 4, totalCount: 117 }" :ratings="[0, 1, 2, 3, 4]"  />  

          <form @submit.prevent="handleAddToCart" class="mt-10">
            <!-- Colors -->              
              <ProductColor :colors="product.colors" @click="handleSelectedColor" />  
              <!-- Sizes -->
              <ProductSize @click="handleSelectedSized" :sizes="product.sizes" /> 
              <!-- <CartQty class="mt-12" v-model="form.qty"></CartQty> -->
            <button  type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button>
          </form>
          
          <div class="py-10 lg:col-span-2 lg:col-start-1  lg:pt-6 ">

          <!-- Description and details -->
          <ProductDescription :description="product.description " />
      
          <ProductHighlist :highlights="product.highlights" />

          <ProductDetails :details="product.details" />
            
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="p-4">
      <ReviewList :reviews="product.reviews" :product_uuid="product.uuid" />
  </div>
   
</AppLayout>
</template>
  
<script setup>
import { ref, defineAsyncComponent } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
// layouts
import AppLayout from '@/Shared/Layouts/App.vue'
//components
import ProductTitle from '@/Shared/components/product/ProductTitle.vue'
import ProductColor from '@/Shared/components/product/ProdutColor.vue'
import ProductSize from '@/Shared/components/product/ProductSize.vue'
import ProductDescription from '@/Shared/components/product/ProductDescription.vue'
import ProductHighlist from '@/Shared/components/product/ProductHighlist.vue'
import ProductDetails from '@/Shared/components/product/ProductDetails.vue'
import ProductReviews from '@/Shared/components/product/ProductReviews.vue'
import ProductImageGallary from '@/Shared/components/product/ProductImageGallary.vue'
import CartQty from '@/Shared/components/cart/CartQty.vue'

import ReviewList from '@/Shared/Reviews/ReviewList.vue';

import { PlusIcon, MinusIcon, } from '@heroicons/vue/20/solid'

const Alert = defineAsyncComponent(() => import('@/shared/Alerts/Alert.vue'))

const  props = defineProps({
  product: Object,
  status: {
    type: Object,
    default: {
      success: false,
      error: false,
      message: null,
    }
  }
})




const { id, name, regular_price, short_description, long_description, images, category, reviews, uuid } = props.product.data;

const form = useForm({
  product_id: null, 
  qty: 1,
  properties: [
    { name : 'color', value : '' },
    { name : 'size',  value : '' }
  ]
})


const product = ref({
  id: id,
  uuid: uuid,
  name: name,
  price: `$${regular_price}`,
  href: '#',
  breadcrumbs: [
    { id: 1, name: 'Shop', href: '/collections' },
    { id: 2, name: category.name, href: `/collections/${category.slug}` },
  ], 
  images: images,
  colors: [
    { name: 'White', class: 'bg-white', selectedClass: 'ring-gray-400' },
    { name: 'Gray',  class: 'bg-gray-200', selectedClass: 'ring-gray-400' },
    { name: 'Black', class: 'bg-gray-900', selectedClass: 'ring-gray-900' },
  ],
  sizes: [
    { name: 'XXS', inStock: false },
    { name: 'XS', inStock: true },
    { name: 'S', inStock: true },
    { name: 'M', inStock: true },
    { name: 'L', inStock: true },
    { name: 'XL', inStock: true },
    { name: '2XL', inStock: true },
    { name: '3XL', inStock: true },
  ],
  description: short_description,
    
  highlights: [
    'Hand cut and sewn locally',
    'Dyed with our proprietary colors',
    'Pre-washed & pre-shrunk',
    'Ultra-soft 100% cotton',
  ],

  details: long_description,
  reviews : reviews
    
})


const handleSelectedSized = (value) => {
  form.properties[1].value = value;
}

const handleSelectedColor = (value) => {
  form.properties[0].value = value;
}

const handleAddToCart = () => {
 
  form.product_id = product.value.id
 
  form.post('/cart/store');
}

// const selectedColor = ref(product.colors[0])
// const selectedSize = ref(product.sizes[2])
</script>