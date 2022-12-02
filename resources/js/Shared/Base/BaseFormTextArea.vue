<template>
    <div class="block mb-6">
        <label for="message" class="block text-sm font-medium text-gray-700" :class="{ 'text-rose-500': errors }">{{ label }}</label>
        <div class="mt-1">
            <BaseTextArea :id="name" :name="name" rows="3" :value="modelValue" :placeholder="placeholder" @input="updateInput" :errors="errors"></BaseTextArea>
        </div>
        <small class="block py-1 text-rose-500" v-if="errors">
            {{ errors }}
        </small>
    </div>
</template>

<script setup>
import BaseTextArea from './BaseTextArea.vue';
const prop = defineProps({
    label: {
        required: true,
        type: String,
    },
    name: {
        required: false,
        type: String,

    },   
    placeholder: {
        required: false,
        type: String,
    },   
    modelValue: { type: [String, Object] },

    errors: {
        type: String,
    }


});

const emits = defineEmits(['update:modelValue'])

const updateInput = (event) => {
    emits("update:modelValue", event.target.value);
}

</script>