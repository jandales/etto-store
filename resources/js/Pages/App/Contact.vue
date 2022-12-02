

<template>
    <AppLayout>
        <PageWrapper>

            <Alert v-if="$page.props.status.success" :alert="'success'" :message="$page.props.status.message"   @close="$page.props.status.success = false"  />
            <Alert v-if="$page.props.status.error"   :alert="'error'"  :message="$page.props.status.message"  @close="$page.props.status.error   = false" />

        <div class=" bg-white flex flex-col gap-8 lg:flex-row lg:gap-4">
            <div class="w-full lg:w-1/2">
                <PageTitle :title="title" />
            <p class="mt-2"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
            <ul class="flex flex-col gap-4 py-4 lg:py-16">
                <li>
                    <div class="flex items-center gap-2">
                        <span><PhoneIcon class="h-5 w- text-indigo-500" /></span>
                        <label class="text-base text-gray-900">+(123) 398 4242</label>
                    </div>
                </li>
                <li >
                    <div class="flex items-center gap-2">
                        <span><EnvelopeIcon class="h5 w-5 text-indigo-500" /></span>
                        <label class="text-base text-gray-900">ettodev@gmail.com</label>
                    </div>
                </li> 
                <li >
                    <div class="flex items-center gap-2">
                        <span><MapPinIcon class="h-5 w-5 text-indigo-500" /></span>
                        <label class="text-base text-gray-900">Purok II, Brgy, Lagundi Allen Northern Samar</label>
                    </div>
                </li>      
            </ul>

            <ul class="flex gap-4">
                <li v-for="site in socialSites" :key="site.name">
                   
                    <a :href="site.href" class="text-indigo-500">                    
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512" class="h-6 w-6 text-indigo-500"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            <path
                                d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                        </svg>
                    </a>
                </li>
            </ul>

            </div>
            <div class="w-full lg:max-w-sm lg:ml-auto">
                <div class="bg-white border rounded-md px-6 py-8 shadow sm:overflow-hidden sm:rounded-md">

               
                <FormBlock 
                    :label="'Name'"
                    :id="'name'" 
                    :name="'name'" 
                    :type="'text'"              
                    v-model="form.name"
                    :disabled="form.processing"
                    :placeholder="'Your name'"
                    :errors="form.errors.name"
                />
                    
                 <FormBlock 
                    :label="'Email'"
                    :id="'email'" 
                    :name="'email'" 
                    :type="'email'" 
                    v-model="(form.email)" 
                    :disabled="form.processing"
                    :placeholder="'Your email address'"
                    :errors="form.errors.email"
                 />     

                <BaseFormTextArea 
                    :label="'Message'" 
                    :name="'message'" 
                    :placeholder="'Type your message here'" 
                    v-model="form.content" 
                    :errors="form.errors.content"
                />

                <div class="block mb-6">
                    <BaseButton @click="handleMessageUs">SEND MESSAGE</BaseButton>
                </div>
            


                
                </div>
            </div>
        </div>
        </PageWrapper>
    </AppLayout>
</template>

<script setup>
import { defineAsyncComponent } from 'vue';
// layouts
import AppLayout from '@/Shared/Layouts/App.vue';
// components
import PageWrapper from '@/Shared/components/PageWrapper.vue'
import PageTitle from '@/Shared/components/PageTitle.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'
import FormBlock from '@/Shared/Base/FormBlock.vue'
import BaseFormTextArea from '@/Shared/Base/BaseFormTextArea.vue';
// icons
import { PhoneIcon, EnvelopeIcon, MapPinIcon } from '@heroicons/vue/20/solid'

import { useForm } from '@inertiajs/inertia-vue3';

const Alert = defineAsyncComponent(() => import('@/Shared/Alerts/Alert.vue'));

const title = 'Contact Us'

const form = useForm({
    name: null,
    email: null,
    content : null,
})

const handleMessageUs = () => {
    form.post('/contact-us/send/message');
}


const socialSites = [
    {
        name: 'facebook',
        href: '#',        
        icon: 'fa-brands fa-facebook'
    },

    {
        name: 'twitter',
        href: '#',
        icon: 'fa-brands fa-twitter'
    },

    {
        name: 'linkedin',
        href: '#',
        icon: 'fa-brands fa-linkedin'
    },

    {
        name: 'instagram',
        href: '#',
        icon: 'fa-brands fa-instagram'
    }
]

</script>