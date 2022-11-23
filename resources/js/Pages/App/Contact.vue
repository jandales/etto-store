<script setup>
// layouts
import AppLayout from '@/Shared/Layouts/App.vue';
// components
import PageWrapper from '@/Shared/components/PageWrapper.vue'
import PageTitle from '@/Shared/components/PageTitle.vue'
import BaseButton from '@/Shared/Base/BaseButton.vue'
import BaseTextArea from '@/Shared/base/BaseTextArea.vue'
// icons
import { PhoneIcon, EnvelopeIcon, MapPinIcon } from '@heroicons/vue/20/solid'

const title = 'Contact Us'

</script>

<template>
    <AppLayout>
        <PageWrapper>
        <div class=" bg-white flex flex-col gap-8 lg:flex-row lg:gap-4">
            <div class="w-full lg:w-1/2">
                <PageTitle :title="title" />
            <p class="mt-2"> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
            <ul class="flex flex-col gap-4 py-4 lg:py-16">
                <li  >
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
                <li><a href=""><font-awesome-icon icon="fa-brands fa-facebook" class="text-indigo-500" /></a></li>
                <li><a href=""><font-awesome-icon icon="fa-brands fa-twitter" class="text-indigo-500" /></a></li>
                <li><a href=""><font-awesome-icon icon="fa-brands fa-linkedin" class="text-indigo-500" /></a></li>
                <li><a href=""><font-awesome-icon icon="fa-brands fa-instagram" class="text-indigo-500" /></a></li>
            </ul>
            </div>
            <div class="w-full lg:max-w-sm lg:ml-auto">
                <div class="bg-white border rounded-md px-6 py-8 shadow sm:overflow-hidden sm:rounded-md">

                <div class="block mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Your name</label>
                    <input type="text" name="name" id="name" autocomplete="name" placeholder="Your name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="block mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input type="email" name="email" id="email" autocomplete="email" placeholder="Email address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="block mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <div class="mt-1">
                    <BaseTextArea id="message" name="message" rows="3" placeholder="Type your message here"></BaseTextArea> 
                </div>             
                </div>

                <div class="block mb-6">
                    <BaseButton>SEND MESSAGE</BaseButton>
                </div>
            


                
                </div>
            </div>
        </div>
        </PageWrapper>
    </AppLayout>
</template>