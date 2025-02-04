<script setup>
import {ref} from 'vue';
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import MainBanner from "@/AppComponents/MainBanner.vue";
import TodaysFreeTips from "@/AppComponents/TodaysFreeTips.vue";
import AppPopUp from "@/AppComponents/AppPopUp.vue";
import YesterdayFreeTips from "@/AppComponents/YesterdayFreeTips.vue";

const props = defineProps(['tips']);


</script>

<template>
    <!--    header-->
    <Head><title>Welcome</title></Head>

    <!--    navigation-->
    <Navigation/>

    <!--    banner-->
    <MainBanner/>

    <!--    free tips-->
    <TodaysFreeTips :tips="tips"/>

<!--    <YesterdayFreeTips :tips="tips"/>-->

    <!--    &lt;!&ndash; Popup Modal &ndash;&gt;-->
    <!--    <AppPopUp/>-->

    <app-footer-main/>
</template>
