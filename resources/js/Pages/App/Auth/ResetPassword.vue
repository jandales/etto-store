<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <Alert v-if="$page.props.status.success" :alert="'success'" :message="$page.props.status.message"
                @close="$page.props.status.success = false" />
            
            <Alert v-if="$page.props.status.error" :alert="'error'" :message="$page.props.status.message"
                @close="$page.props.status.error = false" />
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Reset password
                </h2>

            </div>
            <div class="mt-8 space-y-6">
             
                <div class="-space-y-px rounded-md shadow-sm">

                    <FormBlock 
                        :type="'password'" 
                        :label="'New password'" 
                        :name="'new_password'" 
                        :placeholder="'New password'"
                        :errors="form.errors.new_password"
                        v-model="form.new_password"
                     />

                    <FormBlock 
                        :type="'password'" 
                        :label="'Confirm new password'"
                        :name="'new_password_confirmation'" 
                        :placeholder="'Confirm new password'"
                        :errors="form.errors.new_password_confirmation"
                        v-model="form.new_password_confirmation"
                    />  

                </div>

                <div>
                    <BaseButton @click="handleSubmit">
                        Save Password
                    </BaseButton>                   
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent } from 'vue';

import FormBlock from '@/Shared/Base/FormBlock.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'));

const props = defineProps({
    token : String,
})

const form = useForm({
    token : props.token,
    new_password : null,
    new_password_confirmation : null,
});

const handleSubmit = () => {
    form.post(`/account/password/update`);
}
</script>