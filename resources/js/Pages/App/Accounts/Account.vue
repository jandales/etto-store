<template>
  <Account>

    <Alert v-if="status.success" :alert="'success'" :message="status.message" @close="status.success = false" />
    <Alert v-if="status.error" :alert="'error'" :message="status.message" @close="status.error = false" />

    <AccountPageHeading :title="title">
      <p class="text-gray-500 mt-2">Personal details</p>
    </AccountPageHeading>

    <div class="overflow-hidden mt-5 ">



    
            <!-- <div class="flex -space-x-2 overflow-hidden mb-4">
              <img class="inline-block h-16 w-16 rounded-full ring-2 ring-white"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="" />
            </div> -->

                <div class="mb-4">    
                  <div class="mt-1 flex items-center">
                    <img 
                        class="inline-block h-16 w-16 rounded-full ring-2 ring-white"
                        :src="[$page.props.auth.user.data.avatar ? $page.props.auth.user.data.avatar : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80']"
                        alt="" 
                    />
                    <label for="file-upload"
                      class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                      <span>Change</span>
                      <input id="file-upload"  @change="handleChangeAvatar($event)" name="file-upload" type="file" class="sr-only" />
                    </label>

                  </div>
                </div>

   

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
import { ref, provide, getCurrentInstance, defineAsyncComponent, computed } from 'vue'
import { useForm, usePage } from '@inertiajs/inertia-vue3'

import AccountPageHeading from '@/Shared/components/AccountPageHeading.vue'
import BaseButton from "@/Shared/Base/BaseButton.vue"
import FormBlock from '@/Shared/Base/FormBlock.vue'
import Account from '@/Shared/Layouts/Account.vue'
import { Inertia } from '@inertiajs/inertia'

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'))

const app = getCurrentInstance()
const title = 'Edit Profile'
const open = ref(false)

const authUser = app.attrs.auth.user.data;



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
  avatar: authUser.avatar,
})


const handleUpdate = () => {
  form.post('/account/update');
}

const handleChangeAvatar = (event) => {
    const file = event.target.files[0];
    form.avatar = file; 
    // isImageChange.value = true;;
  form.post('/account/upload/avatar',
      { _method: 'put', avatar: form.avatar },{
      forceFormData: true,
      preserveScroll: true,
      resetOnSuccess: false,
  });
    // Inertia.reload({ only: ['auth.user'] })
 
  form.avatar = app.attrs.auth.user.data.avatar;
      
}



</script>