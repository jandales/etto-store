<template>
            <div class="mt-10">
              <h2 class="text-sm font-medium text-gray-900">Details</h2>
  
              <div class="mt-4 space-y-6">
                <p class="text-sm text-gray-600">{{ details }}</p>
              </div>
            </div>

</template>

<script setup>
const props =  defineProps({
    details : {
        required : true,
        type : String,
    }
});
</script>