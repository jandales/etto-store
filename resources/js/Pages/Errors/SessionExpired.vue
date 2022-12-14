<template>
   <div class="h-screen w-full flex justify-center items-center">
           <div class="flex gap-4">
                <div class="self-start">
                    <h1 class="text-5xl font-bold text-indigo-500">{{ code }}</h1>
                </div>
                <div class="h-14 border-r"></div>
                <div>
                    <p class="text-5xl font-bold block text-gray-900 mb-12">{{ message }}</p>
                    <a href="/" class="bg-indigo-700 px-4 py-2 rounded-md text-white hover:bg-indigo-600">Go Back Home</a>
                </div>
           </div>
   </div>
</template>
<script setup>
defineProps({
    message: String,
    code: {
        type: Number,
        default : 404,
    }
})
</script>