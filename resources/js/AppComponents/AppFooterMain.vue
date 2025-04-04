<script setup>
import {ref} from 'vue';

const icons = ref([
    {name: 'Facebook',width:20, link: '/storage/System/Icons/facebook.png'},
    {name: 'Instagram', width:20, link: '/storage/System/Icons/instagram.png'},
    {name: 'WhatsApp',width:20, link: '/storage/System/Icons/whatsapp.png'},
    {name: 'X',width:20, link: '/storage/System/Icons/x.png'},
    {name: 'Youtube',width:22, link: '/storage/System/Icons/youtube.png'},
]);

function navigateTo(link) {
    window.open(link, '_blank');
}
</script>
<template>
    <section class="container p-0">
        <div class="">
            <div class="bg-[#d88731] rounded p-[10px]">
                <div class="flex items-center justify-between">
                    <section class=" gap-[20px]">
                        <ul class="text-sm">
                            <Link :href="'/about'" as="li">About Us</Link>
                            <Link :href="'/faq'" as="li">FAQs</Link>
                            <Link :href="'/privacyPolicy'" as="li">Privacy Policy</Link>
                            <Link :href="'/termsOfService'" as="li">Terms Of Service</Link>
                        </ul>
                    </section>
                    <section class="h-[100%] flex-col">
                        <div class="flex justify-end ml-[10px] w-full mb-[10px]">
                            <img class="w-[80px]" src="/storage/System/Icons/logo-dark.png"/>
                        </div>
                        <ul class="flex gap-1">
                            <a target="blank" :href="item.link" v-for="item in icons">
                                <img :width="item.width" :src="item.link" alt="instagram-new--v1"/>
                            </a>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
        <div class="flex text-center justify-center text-xs p-[10px]">
            <p class="text-black">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
        </div>
    </section>
</template>
<style scoped lang="scss">
ul {
    @apply m-0 p-0;
    li{
        @apply cursor-pointer;
    }
}
</style>
