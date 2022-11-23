<template>
   <button type="submit" v-bind="$attrs"
      class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
      :class="{ 'disabled:opacity-25': disabled }">
      <slot></slot>
   </button>
</template>

<script setup>
defineProps({
   disabled: Boolean,
})
</script>