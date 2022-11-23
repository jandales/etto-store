<template>
  <Account>

    <Alert v-if="status.success" :alert="'success'" :message="status.message" @close="status.success = false" />
    <Alert v-if="status.error" :alert="'error'" :message="status.message" @close="status.error = false" />

    <AccountPageHeading :title="title">
      <p class="text-gray-500 mt-2">Personal details</p>
    </AccountPageHeading>

    <div class="overflow-hidden mt-5 ">

      <form @submit.prevent="handleUpdate" method="post">

        <FormBlock v-model="form.firstname" :label="'First Name'" :name="'firstname'" :placeholder="'First name'"
          :type="'text'" />

        <FormBlock v-model="form.lastname" :label="'Last Name'" :name="'lastname'" :placeholder="'Last name'"
          :type="'text'" />

        <FormBlock :label="'Email Address'" v-model="form.email" :name="'email'" :type="'email'"
          :placeholder="'Email Address'" :disabled="true" />

        <FormBlock v-model="form.phone" :label="'Phone Number'" :name="'phone'" :placeholder="'Phone Number'"
          :type="'tel'" />

        <FormBlock v-model="form.birth_date" :label="'Birth Date'" :name="'phone'" :type="'date'" />

        <BaseButton class="w-40">
          Save Changes
        </BaseButton>

      </form>


    </div>



  </Account>


</template>     
<script setup>
import { ref, provide, getCurrentInstance, defineAsyncComponent } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'

import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue'
import BaseButton from "@/Shared/Base/BaseButton.vue"
import FormBlock from '@/Shared/Base/FormBlock.vue'
import Account from '@/Shared/Layouts/Account.vue'

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'))

const app = getCurrentInstance()
const title = 'Edit Profile'
const open = ref(false)
const authUser = app.attrs.auth.user.data

defineProps({
  status: {
    type: Object,
    default: {
      success: false,
      error: false,
      message: null,
    },
  }
})

provide('menu', {
  open,
  toggle: () => open.value = true,
})



const form = useForm({
  id: authUser.id,
  firstname: authUser.firstname,
  lastname: authUser.lastname,
  email: authUser.email,
  phone: authUser.phone,
  birth_date: authUser.birth_date,
})


const handleUpdate = () => {
  form.post('/account/update');
}



</script>