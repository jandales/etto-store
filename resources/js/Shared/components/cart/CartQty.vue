<template>
     <div class="relative h-fit w-32 rounded-md shadow-sm overflow-hidden">
            <div @click="deduct" class=" absolute inset-y-0 left-0 flex items-center px-3 hover:bg-gray-200">
               <MinusIcon class="text-gray-500 h-5 w-5 flex-shrink-0"/>
            </div>
            <input type="number" v-model="modelValue" @input="updateInput" name="price" id="price" class="block w-full rounded-md text-center appearance-none border-gray-300 pl-12 pr-12 focus:border-indigo-500 focus:ring-indigo-500  sm:text-sm" placeholder="1">
            <div @click="add" class="absolute inset-y-0 right-0 flex items-center px-3 hover:bg-gray-200 ">
               <PlusIcon  class="text-gray-500 h-5 w-5 flex-shrink-0" /> 
         </div>
    </div>
</template>
<script setup>
import { PlusIcon, MinusIcon, } from '@heroicons/vue/20/solid'

const props = defineProps({
   modelValue: { type: Number },
})
const emits = defineEmits(['update:modelValue'])

const updateInput = (event) => {
   emits("update:modelValue", event.target.value);
}

const add = () => {
   const value = props.modelValue + 1;
   emits("update:modelValue", value);
}

const deduct = () => {
   const currentValue = props.modelValue;
   if (currentValue <= 1) return;
   const value = currentValue - 1;
   emits("update:modelValue", value); 
}

</script>