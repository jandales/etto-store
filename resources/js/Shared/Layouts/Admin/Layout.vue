<template>
  <div class="w-full flex bg-gray-100 ">

    <div class="w-60">
      <Sidebar />
    </div>

    <div class="lg:w-[calc(100%_-_15rem)]">
        <Header /> 
        <main>
          <div class="p-6">
            <slot></slot>
          </div>
        </main>
        
    </div>

    

   

</div>
</template>

<script setup>
import Sidebar from '../../../Shared/Layouts/Admin/Sidebar.vue'
import Header from '../../../Shared/Layouts/Admin/Header.vue'
</script>