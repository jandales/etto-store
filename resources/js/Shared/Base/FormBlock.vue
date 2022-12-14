<template>
    <div class="mb-4">
        <label  :class="[errors ? 'text-rose-500' : 'text-slate-900','block mb-2']">{{ label }}</label>
        <input 
        :id="name" 
        :name="name" 
        :type="type" 
        :autocomplete="name" 
        :value="modelValue" 
        :disabled="disabled"
        :placeholder="placeholder"
        @input="updateInput"
        class="relative block w-full appearance-none  rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
        :class="{ 'border-rose-500 placeholder:text-rose-500': errors }" />
        
        <div class="w-full" v-if="Array.isArray(errors)">
            <small class="block py-1 text-rose-500" v-for="error in errors">
                {{ error }}
            </small>
        </div>
        <div class="w-full" v-else>
            <small class="block py-1 text-rose-500">
                {{ errors }}
            </small>
        </div>


        

    

        
    </div>
</template>
<script setup>



const props = defineProps({
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
        type: [String,Number],
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
    modelValue: {
        type: [String, Object]
    },
    
    errors : {
        type : [Array, Object],
    }
});

const emits = defineEmits(['update:modelValue'])

const updateInput = (event) => {
    emits("update:modelValue", event.target.value);
}


</script>