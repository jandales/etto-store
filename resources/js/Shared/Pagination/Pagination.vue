<template>
  <div class="flex items-center justify-between mt-8">
    <div>
      <label class="text-gray-700 text-sm">Page : 1 of 100</label>
    </div>
    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
      <PagePrev />
      <Page :page="{ link: '#', name: 1 }" :isActive="true" />
      <Page :page="{ link: '#', name: 2 }" />
      <Page :page="{ link: '#', name: 3 }" />
      <PageDiveder />
      <Page :page="{ link: '#', name: 8 }" />
      <Page :page="{ link: '#', name: 9 }" />
      <Page :page="{ link: '#', name: 10 }" />
      <PageNext />
    </nav>
  </div>
</template>

<script setup>
import Page from './Page.vue';
import PageNext from './PageNext.vue';
import PagePrev from './PagePrev.vue';
import PageDiveder from './PageDiveder.vue';

</script>