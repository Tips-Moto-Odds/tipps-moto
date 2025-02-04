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
    <section class="px-[10px]">
        <div class=" bg-[#d88731] rounded">
            <div class="flex p-4 items-center justify-between">
                <section class=" gap-[20px]">
                    <ul class="text-sm">
                        <Link :href="'/about'" as="li">About Us</Link>
<!--                        <Link :href="'/contact-us'" as="li">Contact Us</Link>-->
                        <Link :href="'/faq'" as="li">FAQs</Link>
                        <Link :href="'/privacyPolicy'" as="li">Privacy Policy</Link>
                        <Link :href="'/termsOfService'" as="li">Terms Of Service</Link>
                    </ul>
                </section>
                <section class="h-[100%] flex items-center">
                    <ul class="flex gap-1">
                        <a target="blank" :href="item.link" v-for="item in icons">
                            <i class="bi text-[18px] text-white" :class="[item.icon]"></i>
                        </a>
                    </ul>
                    <div class=" flex md:justify-end ml-[10px] w-full">
                        <img class="w-[80px]" src="storage/System/Icons/logo-dark.png">
                    </div>
                </section>
            </div>
        </div>
    </section>
    <div class="container flex text-center justify-center text-sm p-[10px]">
        <p class="text-black">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
    </div>
</template>
<style scoped lang="scss">
ul {
    @apply m-0 p-0;
}
</style>
