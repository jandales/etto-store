<template>

  <AppLayout>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">

        <Alert
          v-if="$page.props.status.success"
          :alert="'success'"
          :message="$page.props.status.message"
          @close="$page.props.status.success = false"
        />
        
        <Alert
          v-if="$page.props.status.error"
          :alert="'error'"
          :message="$page.props.status.message"
          @close="$page.props.status.error = false"
        />

        

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
              <Link href="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your
                password?</Link>
            </div>
          </div>

          <div>
            <BaseButton :disabled="form.processing">
              Sign in
            </BaseButton>
            <Link href="/register" class="mt-4 text-center text-sm block font-medium text-indigo-600 hover:text-indigo-500 hover:underline">Create account</Link>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>

</template>
  
<script setup>
import { defineAsyncComponent } from 'vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

import AppLayout from '@/Shared/Layouts/App.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'
import FormBlock from '@/Shared/Base/FormBlock.vue'


const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'));

const form = useForm({
  email: null,
  password: null,
})

const handleSubmit = () => {
  form.post('/login');
}

</script>