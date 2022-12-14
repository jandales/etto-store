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
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Reset your password</h2>          
        <p class="block text-center text-sm text-gray-400 mt-8">We will send you an email to reset your password.</p>
      </div>
      <div class="mt-8 space-y-6">       
        <div class="-space-y-px rounded-md shadow-sm">
          <FormBlock
            :label="'Email Address'"
            :id="'email'"
            v-model="form.email" 
            :name="'email'"
            :type="'email'"
            autocomplete="email"            
            :errors="form.errors.email" 
          />              
        </div> 
        <div>
          <BaseButton @click="handleSubmit" :disabled="form.processing">
            Submit
          </BaseButton>
        </div>
      </div>
    </div>
  </div>
  </AppLayout>
 
</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
  //components 
import AppLayout from '@/Shared/Layouts/App.vue';
import BaseButton from '@/Shared/base/BaseButton.vue';
import FormBlock from '@/Shared/Base/FormBlock.vue';
import { defineAsyncComponent } from 'vue';

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'));


const form = useForm({
    email : null,
})

const handleSubmit = () => {
  form.post('/auth/forgot/password');
}

</script>