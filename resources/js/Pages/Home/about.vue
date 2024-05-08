<script setup>
import MobilMenu from "@/AppComponents/Mobil-Menu.vue";
import {Link} from "@inertiajs/vue3";
import MenuPanel from "@/AppComponents/Menu-panel.vue";

const handleOpening = () => $("#main-site-menu").css('right','100%')
const handelClosing = () => $('#main-site-menu').css('right','0%')

</script>

<template>
    <MobilMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobilMenu>
    <menu-panel></menu-panel>
    <p>About</p>

</template>

<style scoped lang="scss">
#main-site-menu {
    position: fixed;
    right: 100%;
    transition: all ease 250ms;

    a{
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active{
        @apply text-orange-400;
    }
}
</style>
