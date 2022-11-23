<template>
    <div class="mb-4">
        <label :for="label" class=" block text-slate-900 mb-2" :class="{ 'text-rose-500': errors }">{{ label }}</label>
        <input 
        :id="name" 
        :name="name" 
        :type="type" 
        :autocomplete="name" 
        v-model="modelValue" 
        :disabled="disabled"
        :placeholder="placeholder"
        @input="updateInput"
        class="relative block w-full appearance-none  rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
        :class="{ 'border-rose-500 placeholder:text-rose-500': errors }" />

        <small class="block py-1 text-rose-500" v-if="errors">
            {{ errors }}
        </small>
    </div>
</template>
<script setup>

const prop = defineProps({
    label: {
        required: true,
        type: String,
    },
    name: {
        required: false,
        type: String,

    },
    type: {
        required: true,
        type: String,
        default: 'text',
    },
    placeholder: {
        required: false,
        type: String,
    },
    disabled: {
        required: false,
        type: Boolean,
        default: false,
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