<template>
  <AppLayout>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8">
        <div>
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create account</h2>
        </div>
        <form @submit.prevent="handleRegister" class="mt-8 space-y-6" action="#" method="POST">
          <div class="rounded-md shadow-sm">

            <FormBlock v-model="form.firstname" :type="'text'" :label="'First Name'" :name="'firstname'"
              :placeholder="'First Name'" :errors="form.errors.firstname" />

            <FormBlock v-model="form.lastname" :type="'text'" :label="'Last Name'" :name="'lastname'"
              :placeholder="'Last Name'" :errors="form.errors.lastname" />

            <FormBlock v-model="form.email" :type="'email'" :label="'Email Address'" :name="'email'"
              :placeholder="'Email Address'" :errors="form.errors.email" />

            <FormBlock v-model="form.password" :label="'Password'" :type="'password'" :name="'password'"
              :placeholder="'Password'" :errors="form.errors.password" />

            <div>
            </div>
            <BaseButton :disabled="form.processing">
              Create
            </BaseButton>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>

</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

import AppLayout from '@/Shared/Layouts/App.vue'

import BaseButton from '@/Shared/Base/BaseButton.vue';
import FormBlock from '@/Shared/Base/FormBlock.vue';

const form = useForm({
  firstname: null,
  lastname: null,
  email: null,
  password: null,
})

const handleRegister = () => {
  form.post('/register');
}


</script>