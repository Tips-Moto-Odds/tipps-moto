<script setup>
import {ref} from 'vue';

const icons = ref([
    {name: 'Instagram', icon: 'bi-meta', link: 'https://www.instagram.com'},
    {name: 'Facebook', icon: 'bi-instagram', link: 'https://www.facebook.com'},
    {name: 'Twitter', icon: ' bi-twitter-x', link: 'https://www.twitter.com'},
    {name: 'WhatsApp', icon: 'bi-whatsapp', link: 'https://www.whatsapp.com'}
]);

function navigateTo(link) {
    window.open(link, '_blank');
}
</script>
<template>
    <div class="container !bg-[#D88731] text-white rounded">
        <div class="flex justify-between rounded mb-[20px]  p-[20px]">
            <section class="flex gap-[20px]">
                <div>
                    <h5 class="h5 font-bold">Links</h5>
                    <ul>
                        <li>Tips</li>
                        <li>Jackpots</li>
                        <li>Dashboard</li>
                        <li>About Us</li>
                        <li>Contact</li>
                    </ul>
                </div>
                <div>
                    <h5 class="h5 font-bold">Resources</h5>
                    <ul>
                        <li>Blog</li>
                        <li>FAQs</li>
                        <li>PrivacyPolicy</li>
                        <li>Help Center</li>
                        <li>Site Map</li>
                    </ul>
                </div>
            </section>
            <section class="h-[100%]">
                <div class=" flex justify-end mb-[20px] w-full">
                    <img class="w-[100px]" src="storage/System/Icons/logo-dark.png">
                </div>
                <ul class="flex gap-[20px]">
                    <a as="li" :href="item.link" v-for="item in icons">
                        <i class="bi text-[20px]" :class="[item.icon]"></i>
                    </a>
                </ul>
            </section>
        </div>
    </div>
    <div class="container flex justify-center p-[20px]">
        <p class="text-white">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
    </div>
</template>
