<script setup>
import LinkList from './links/LinkList.vue';



const shop = {
    title : 'Shop',
    links : [
        { name : 'Bag',  url : null },
        { name : 'Tees',  url : null },
        { name : 'Objects',  url : null },
        { name : 'Home Goods',  url : null },
        { name: 'accessories',  url : null },
    ]
}

const company = {
    title : 'Campany',
    links : [
        { name : 'Who we are',  url : null },
        { name : 'Terms and Conditions',  url : null },
        { name : 'Privacy',  url : null },    
    ]
}

const account = {
    title : 'Account',
    links : [
        { name : 'Manage Account',  url : null },
        { name : 'Return and Exchanges',  url : null },
        { name : 'Redeem a gift Card',  url : null },    
    ]
    
}

const connect = {
    title : 'Connect',
    links : [
        { name : 'Contact us',  url : null },
        { name : 'Twitter',  url : null },
        { name : 'Instagram',  url : null },
        { name : 'Pinterest',  url : null },    
    ]
    
}

</script>
<template>
    <div class="mt-6 w-full lg:w-[calc(100%_-_24rem)] grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                <LinkList :title="shop.title" :links="shop.links" />

                <LinkList :title="company.title" :links="company.links" />

                <LinkList :title="account.title" :links="account.links" />   

                <LinkList :title="connect.title" :links="connect.links" />                 


    </div>
</template>