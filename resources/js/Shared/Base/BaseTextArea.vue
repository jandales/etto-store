<template>
    <textarea v-bind="$attrs" :value="modelValue" @input="updateInput" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" :class="{ 'border-rose-500 placeholder:text-rose-500 ': errors }" placeholder="Type your message here" ></textarea>
</template>
<script setup>
const props =  defineProps({
    modelValue: { type: [String, Object] },
    errors : String,
});

const emits = defineEmits(['update:modelValue'])

const updateInput = (event) => {
    emits("update:modelValue", event.target.value);
}
</script>