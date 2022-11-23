
<template>
  <AccountPageHeading :title="title">
    <p class="text-gray-500 mt-2">Personal details</p>
  </AccountPageHeading> 
  
  <div class="overflow-hidden mt-5 ">  
    
    <FormBlock
      :label="'Name'"
      :name="'name'"   
      :placeholder="'Name'"
      :type="'text'"
    />

    <FormBlock
      :label="'Email Address'"
      :name="'email'"   
      :type="'email'"
      :placeholder="'Email Address'"
      :disabled="true"
    />

    <FormBlock
      :label="'Phone Number'"
      :name="'phone'"  
      :placeholder="'Phone Number'" 
      :type="'tel'"
    />

    <FormBlock
      :label="'Birth Date'"
      :name="'phone'"   
      :type="'date'"
    />

    <BaseButton class="w-40">
      Save Changes
    </BaseButton>

  </div>
  
  
  
  </template>
<script setup>


</script>
  