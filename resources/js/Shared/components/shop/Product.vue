<script setup>
import { Link } from '@inertiajs/inertia-vue3'


const props = defineProps({
    product: {
        required: true,
        type: Object
    }
})


</script>
<template>
    <div class="group relative">
        <div
            class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img :src="product.imagePath" :alt="product.name"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full" />
        </div>
        <div class="mt-4 flex justify-between">
            <div>
                <h3 class="text-sm text-gray-700">
                    <Link :href="product.link" class="capitalize">
                        <span aria-hidden="true" class="absolute inset-0" />
                        {{ product.name }}
                    </Link>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ product.category_id }}</p>
            </div>
            <p class="text-sm font-medium text-gray-900">{{ `$ ${product.regular_price}` }}</p>
        </div>
    </div>
</template>

