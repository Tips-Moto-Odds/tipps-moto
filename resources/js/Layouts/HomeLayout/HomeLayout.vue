s<script setup>
import MenuPanel from "@/Layouts/HomeLayout/Components/MenuPanel.vue";
import MobileMenu from "@/Layouts/HomeLayout/Components/MobileMenu.vue";

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')
</script>

<template>
    <MobileMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobileMenu>
    <menu-panel></menu-panel>
    <slot></slot>
</template>

<style scoped lang="scss">

</style>
