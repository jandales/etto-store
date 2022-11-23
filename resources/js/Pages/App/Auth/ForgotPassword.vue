<template>  
    <AppLayout>
      <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>         
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Reset your password</h2>          
          <p class="block text-center text-sm text-gray-400 mt-8">We will send you an email to reset your password.</p>
        </div>
        <form class="mt-8 space-y-6" action="#" method="POST">
          <input type="hidden" name="remember" value="true" />
          <div class="-space-y-px rounded-md shadow-sm">
            <div class="mb-6">
              <label for="email-address"  class=" block text-gray-500 mb-2">Email address</label>
              <input id="email-address" name="email" type="email" autocomplete="email" required="" class="relative block w-full appearance-none  rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
            </div>
          </div> 
          <div>
            <BaseButton>
              Submit
            </BaseButton>
          </div>
        </form>
      </div>
    </div>
    </AppLayout>
 
  </template>
  
  <script setup>
  import AppLayout from '@/Shared/Layouts/App.vue';
  import BaseButton from '@/Shared/base/BaseButton.vue';

  </script>