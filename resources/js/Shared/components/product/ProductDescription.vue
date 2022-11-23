<template>
     <div>
              <h3 class="text-sm font-medium text-gray-900">Description</h3>
  
              <div class="mt-4">
                <p class="text-base text-gray-900">{{ description }}</p>
              </div>
            </div>
  
</template>
<script setup>
const props =  defineProps({
    description : {
        required : true,
        type : String,
    }
});
</script>