<script setup>
import {ref} from 'vue';

const icons = ref([
    {name: 'Instagram', icon: 'bi-instagram', link: 'https://www.instagram.com/tipsmoto_/#'},
    {name: 'Facebook', icon: 'bi-meta', link: 'https://www.facebook.com/profile.php?id=61562999466337&rdid=WRmEVMgsV42bJNVk&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2FQfMjoSwFR8CxewGT%2F#'},
    {name: 'Twitter', icon: ' bi-twitter-x', link: 'https://x.com/TipsMoto_'},
    {name: 'WhatsApp', icon: 'bi-whatsapp', link: 'https://www.whatsapp.com/channel/0029VagdQJFBfxo8DiYaBI06'}
]);

function navigateTo(link) {
    window.open(link, '_blank');
}
</script>
<template>
    <div class="container bg-gray-800 text-white rounded">
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
                    <a target="blank" :href="item.link" v-for="item in icons">
                        <i class="bi text-[20px] text-white" :class="[item.icon]"></i>
                    </a>
                </ul>
            </section>
        </div>
    </div>
    <div class="container flex justify-center p-[20px]">
        <p class="text-white">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
    </div>
</template>
