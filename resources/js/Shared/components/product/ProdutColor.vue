<template>
    <div>
        <h3 class="text-sm font-medium text-gray-900">Color</h3>
        <RadioGroup  class="mt-4">
            <RadioGroupLabel class="sr-only"> Choose a color </RadioGroupLabel>
            <div class="flex items-center space-x-3">
            <RadioGroupOption as="template" v-for="color in colors" :key="color.name" :value="color" v-slot="{ active, checked }" @click="selected(color.name)">
                <div :class="[color.selectedClass, active && checked ? 'ring ring-offset-1' : '', !active && checked ? 'ring-2' : '', '-m-0.5 relative p-0.5 rounded-full flex items-center justify-center cursor-pointer focus:outline-none']">
                    <RadioGroupLabel as="span" class="sr-only"> {{ color.name }} </RadioGroupLabel>
                    <span aria-hidden="true" :class="[color.class, 'h-8 w-8 border border-black border-opacity-10 rounded-full']" />
                </div>
            </RadioGroupOption>
            </div>
        </RadioGroup>
    </div>
</template>
<script setup>

import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'
const props =  defineProps({
    colors : {
        type  : Array
    }
})

const emits = defineEmits(['click']);

const selected = (value) => {
    emits('click', value)
}

</script>