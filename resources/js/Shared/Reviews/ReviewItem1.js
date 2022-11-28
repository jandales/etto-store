import { h } from 'vue'




const ReviewItem1 = (props, context) => {
    return h(`<div  class="flex gap-4 mb-12">  
        <div class="w-10 flex -space-x-2 overflow-hidden">
        <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="" />
        </div>
        <div :class="[${props.index + 1 == props.count ? 'border-b-0' : 'border-b', 'flex-1 pb-12'} ]" >
            <div class="flex justify-between">
                <label class="block text-gray-900 font-semibold">${props.review.user.display_name}</label>
                <span  v-if="${props.auth.user && props.review.user.uuid == props.auth.user.data?.uuid}" @click="destroy(review.uuid)" class="text-rose-400 cursor-pointer hover:text-rose-700">Delete</TextContent>
            </div>
         
            <label class="block text-gray-500">{{ review.date }}</label>     

            <p  class="block text-gray-500">
                {{ review.body }}
            </p>   
        </div>   
    </div>`
, context.attrs, context.slots)
}




export default ReviewItem1


