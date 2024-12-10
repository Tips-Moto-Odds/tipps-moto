s<script setup>
import MobilMenu from "@/Layouts/HomeLayout/Components/Mobil-Menu.vue";
import MenuPanel from "@/Layouts/HomeLayout/Components/Menu-panel.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')
</script>

<template>
    <MobilMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobilMenu>
    <menu-panel></menu-panel>
    <slot></slot>
    <app-footer/>
</template>

<style scoped lang="scss">

</style>
