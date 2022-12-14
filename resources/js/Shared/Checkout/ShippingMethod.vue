<template>
<div class="w-full  border-b mb-12 pb-6">
    <h1 class="text-gray-900 font-semibold mb-4">Shipping Method</h1>
    <div class="w-full">
        <div class="w-full">
            <RadioGroup v-model="selected" @click="updateOption">
                <RadioGroupLabel class="sr-only">Server size</RadioGroupLabel>
                <div class="space-x-8 flex">
                    <RadioGroupOption as="template" v-for="method in shippingMethods" :key="method.uuid" :value="method"
                        v-slot="{ active, checked }">
                        <div :class="[
                            active
                                ? 'ring-2 ring-white ring-opacity-60 ring-offset-2 ring-offset-sky-300'
                                : '',
                            checked ? 'bg-sky-900 bg-opacity-75 text-white border-0' : 'bg-white ',
                        ]"
                            class="relative flex cursor-pointer border w-1/2 rounded-lg px-5 py-4 shadow-md focus:outline-none">
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <RadioGroupLabel as="p" :class="checked ? 'text-white' : 'text-gray-900'"
                                            class="font-medium capitalize">
                                            {{ method.name }}
                                        </RadioGroupLabel>
                                        <RadioGroupDescription as="span"
                                            :class="checked ? 'text-sky-100' : 'text-gray-500'" class="inline">
                                            <span class="block mt-2">{{ method.description }}</span>
                                            <span class="block mt-2">${{ method.amount }}</span>

                                        </RadioGroupDescription>
                                    </div>
                                </div>
                                <div v-show="checked" class="shrink-0 text-white">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="12" fill="#fff" fill-opacity="0.2" />
                                        <path d="M7 13l3 3 7-7" stroke="#fff" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>
    </div>
</div>
</template>
<script setup>
import { ref } from 'vue';
import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupDescription,
    RadioGroupOption,
} from '@headlessui/vue'

const props = defineProps({
    shippingMethods: Array,         
})

const selected = ref(props.shippingMethods[0]);

const emits = defineEmits(['updateOption'])

const updateOption =  () => {
    emits('updateOption', selected.value)
    console.log(selected.value)
}
</script>