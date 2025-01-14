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
    <div class=" mx-[20px] bg-[#d88731] rounded-[24px]">
        <div class="flex justify-between md:flex-row flex-col p-[30px]" >
            <section class="flex gap-[20px] mb-[30px]">
                <div class=" text-black" >
<!--                    <h5 class="h5 font-bold">Links</h5>-->
                    <ul>
                        <Link :href="'/tips'" as="li">Tips</Link>
                        <Link :href="'/dashboard'" as="li">Dashboard</Link>
                        <Link :href="'/about'" as="li">About Us</Link>
                    </ul>
                </div>
                <div class=" text-black ">
<!--                    <h5 class="h5 font-bold">Resources</h5>-->
                    <ul>
                        <Link :href="'/faq'" as="li" >FAQs</Link>
                        <Link :href="'/privacyPolicy'" as="li" >Privacy ssPolicy</Link>
                        <Link :href="'/termsOfService'" as="li" >Terms Of Service</Link>
                    </ul>
                </div>
            </section>
            <section class="h-[100%]">
                <div class=" flex md:justify-end px-[30px] mb-[20px] w-full">
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
    <div class="container flex text-center justify-center p-[10px]">
        <p class="text-black">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
    </div>
</template>
<style scoped lang="scss">
ul{
    @apply m-0 p-0;
}
</style>
