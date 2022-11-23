<template>
         <div class="mt-10">
                <div class="flex items-center justify-between">
                  <h3 class="text-sm font-medium text-gray-900">Size</h3>
                  <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Size guide</a>
                </div> 
        
      <RadioGroup  class="mt-4">
                  <RadioGroupLabel class="sr-only"> Choose a size </RadioGroupLabel>
                  <div class="flex items-center space-x-3">

                    <RadioGroupOption as="template" v-for="size in sizes" :key="size.name" :value="size" :disabled="!size.inStock" v-slot="{ active, checked }" @click="selected(size.name)">

                      <div :class="[size.inStock ? 'bg-white shadow-sm text-gray-900 cursor-pointer' : 'bg-gray-50 text-gray-200 cursor-not-allowed', active ? 'ring-2 ring-indigo-500' : '', 'group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6']">
                        <RadioGroupLabel as="span">{{ size.name }}</RadioGroupLabel>
                        <span v-if="size.inStock" :class="[active ? 'border' : 'border-2', checked ? 'border-indigo-500' : 'border-transparent', 'pointer-events-none absolute -inset-px rounded-md']" aria-hidden="true" />
                        <span v-else aria-hidden="true" class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                          <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                            <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                          </svg>
                        </span>
                      </div>

                    </RadioGroupOption>

                  </div>
                </RadioGroup>
            </div>
</template>
<script setup>

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const emits = defineEmits(['click']);

const selected = (value) => {
  emits('click', value)
}

const props =  defineProps({
    sizes : {
        type  : Array
    }
})
</script>