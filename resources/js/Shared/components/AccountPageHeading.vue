<template>
    <div class="w-full flex items-center gap-2">
        <button  class="flex items-center rounded-md bg-white py-2 mt-1 text-gray-400 lg:hidden" @click="open">
                 <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
        </button>
        <h1 class="text-3xl font-bold text-gray-900">{{ title }}</h1> 
        <slot name="action">
           
        </slot>
    </div>
    <div>
            <slot></slot>
        </div>

</template>
<script setup>
import { inject} from 'vue';
import { Bars3Icon } from '@heroicons/vue/24/outline'
const props =  defineProps({
    title : {
        required : true,
        type: String,
    }
});


const menu = inject('menu');

const open = () => {   
    menu.toggle();
}


</script>