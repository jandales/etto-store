<template>

  <AppLayout>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>
        <form @submit.prevent="handleSubmit" class="mt-8 space-y-6" method="POST">
          <input type="hidden" name="remember" value="true" />
          <div class="rounded-md shadow-sm">

            <FormBlock v-model="form.email" :type="'email'" :label="'Email address'" :name="'email'"
              :placeholder="'Email address'" :errors="form.errors.email" />

            <FormBlock v-model="form.password" :type="'password'" :label="'Password'" :name="'password'"
              :placeholder="'Password'" :errors="form.errors.password" />

          </div>

          <div class="flex items-center justify-between">
            <div class="text-sm">
              <a href="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your
                password?</a>
            </div>
          </div>

          <div>
            <BaseButton :disabled="form.processing">
              Sign in
            </BaseButton>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>

</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

import AppLayout from '@/Shared/Layouts/App.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'
import FormBlock from '@/Shared/Base/FormBlock.vue'

const form = useForm({
  email: null,
  password: null,
})

const handleSubmit = () => {
  form.post('/login');
}

</script>