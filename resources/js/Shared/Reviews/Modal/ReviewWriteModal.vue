<template>
    <TransitionRoot as="template" :show="state">
        <Dialog as="div" class="relative z-10">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
                leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300"
                        enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
                        leave-from="opacity-100 translate-y-0 sm:scale-100"
                        leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <h1 class="text-xl mb-4">Write Review</h1>
                                    <div class="flex items-center gap-4">
                                            <div class="w-10 flex -space-x-2 overflow-hidden">
                                                <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                                    src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                    alt="" />
                                            </div>
                                            <div class="flex-1">
                                                <label>{{ $page.props.auth.user.data.display_name }}</label>
                                            </div>
                                    </div>

                                    <div>

                                        <div class="my-4">
                                            <h3 class="sr-only">Reviews</h3>
                                            <div class="flex items-center">
                                                <div class="flex items-center">
                                                    <h4 class="mr-4">Rate : </h4>
                                                    <StarIcon v-for="index in rate_length" :key="index"
                                                        @click="form.rate = index"
                                                        :class="[form.rate >= index ? 'text-yellow-500' : 'text-gray-200', 'h-6 w-6 flex-shrink-0']"
                                                        aria-hidden="true" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <label class="block mb-2">Review</label>
                                            <textarea v-model="form.body" name="review" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Type your message here"  rows="3">
                                            </textarea>
                                        </div>

                                    </div>
                                   
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button"
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                                    @click="handleSubmit">Submit</button>
                                <button type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                    @click="close" ref="cancelButtonRef">Cancel</button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, watch, computed } from 'vue'
import { useForm, usePage } from  '@inertiajs/inertia-vue3'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { StarIcon } from '@heroicons/vue/20/solid'
import  axios  from 'axios';

const rate_length = ref([1, 2, 3, 4, 5])

const props = defineProps({
    state: {
        type: Boolean, 
        default : false,
    },
    product_uuid : {
        type: String,
        default: null,
        required : true,
    }    
})

const form = useForm({
    rate: 1,
    body : null,
})

const emits = defineEmits(['close']);

const close = () => {
    emits('close')
}


const isOpen = computed(() => {
    return props.state;
})

const handleSubmit = () => {

    form.post(`/review/${props.product_uuid}/store`)
    const { status } = usePage().props.value
    if (status.success = true) {
        emits('close');
    }
}

const handleGetUserReview = async () => {
    const { auth } = usePage().props.value
    const res = await axios.get(`/review/user/${auth.user.data.id}/show`)
    const { data } = res.data;
    form.rate = data.rate ?? 1
    form.body = data.body ?? null
}

watch(isOpen, value => {
    if (value === false) return;
        handleGetUserReview();
});




</script>