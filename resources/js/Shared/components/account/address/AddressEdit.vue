<template>
    <AccountPageHeading :title="title"></AccountPageHeading>
         
    
    <form  class="flex flex-col mt-8 lg:flex-row lg:gap-8">
        <div class="w-full lg:w-1/2">       
          <div class="rounded-md shadow-sm">
            <h2 class="block text-lg text-gray-900 font-semibold mb-4">Contact Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <FormBlock
                    :label="'Firstname'"
                    :name="'firstname'"
                    :type="'text'"
                    :placeholder="'Firstname'"
                />
                <FormBlock
                    :label="'Last name'"
                    :name="'lastname'"
                    :type="'text'"
                    :placeholder="'Lastname'"
                />
            </div>
           

            <FormBlock
                :label="'Phone'"
                :name="'phone'"
                :type="'tel'"
                :placeholder="'Phone Number'"
            /> 

          </div>        
          
    </div>
    <div class="w-full lg:w-1/2">
       
    
        <h2 class="block text-lg text-gray-900 font-semibold mb-4">Address</h2>

            <FormBlock
                :label="'Street'"
                :name="'street'"
                :type="'text'"
                :placeholder="'Street'"
            />           
         

            <FormBlock
                :label="'City'"
                :name="'city'"
                :type="'text'"
                :placeholder="'City'"
            />

            <FormBlock
                :label="'Region'"
                :name="'region'"
                :type="'text'"
                :placeholder="'City'"
            />

            <FormBlock
                :label="'Zipcode'"
                :name="'zipcode'"
                :type="'text'"
                :placeholder="'Zipcode'"
            />          
  
        
            <BaseButton class="lg:w-40">
                Save changes
            </BaseButton>          
       
      
    </div>
    </form>
    



</template>

<script setup>
import BaseButton from "../../base/BaseButton.vue";
import FormBlock from '../../base/FormBlock.vue'
import AccountPageHeading from '../../AccountPageHeading.vue'
const title = 'Edit address'
</script>