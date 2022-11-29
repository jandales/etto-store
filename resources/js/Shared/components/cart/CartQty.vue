<template>
     <div class="relative h-fit w-32 rounded-md shadow-sm overflow-hidden">
            <div @click="deduct" class=" absolute inset-y-0 left-0 flex items-center px-3 hover:bg-gray-200" :class="{'cursor-not-allowed' : disabled}">
               <MinusIcon class="text-gray-500 h-5 w-5 flex-shrink-0"/>
            </div>
            <input type="number" :value="modelValue" @input="updateInput" name="price" id="price" class="block w-full rounded-md text-center appearance-none border-gray-300 pl-12 pr-12 focus:border-indigo-500 focus:ring-indigo-500  sm:text-sm" placeholder="1">
            <div @click="add" class="absolute inset-y-0 right-0 flex items-center px-3 hover:bg-gray-200 " :class="{'cursor-not-allowed' : disabled}">
               <PlusIcon  class="text-gray-500 h-5 w-5 flex-shrink-0" /> 
         </div>
    </div>
</template>
<script setup>
import { PlusIcon, MinusIcon, } from '@heroicons/vue/20/solid'

const props = defineProps({
   modelValue: { type: Number },
   disabled: {
      type: Boolean,
      default : false,
   },
})
const emits = defineEmits(['update:modelValue'])

const updateInput = (event) => {
   emits("update:modelValue", event.target.value);
}

const add = () => {
   if (props.disabled === true) return;

   const value = props.modelValue + 1;
   emits("update:modelValue", value);
  
}

const deduct = () => {
   if (props.disabled === true) return;

   const currentValue = props.modelValue;
   if (currentValue <= 1) return;
   const value = currentValue - 1;
   emits("update:modelValue", value);  
}







</script> 