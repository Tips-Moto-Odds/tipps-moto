<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import MainBanner from "@/AppComponents/MainBanner.vue";
import TodaysFreeTips from "@/AppComponents/TodaysFreeTips.vue";
import AppPopUp from "@/AppComponents/AppPopUp.vue";
import YesterdayFreeTips from "@/AppComponents/YesterdayFreeTips.vue";
import {ref} from 'vue';

const props = defineProps(['tips','yesterdaysTips','canViewFreeTips']);
const showYesterdayTips = ref(false);
const showPopup = ref(false);

</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>

    <Navigation/>

    <MainBanner/>

    <TodaysFreeTips :tips="tips ?? []" :canViewFreeTips/>

    <YesterdayFreeTips v-if="yesterdaysTips.length > 0" :tips="yesterdaysTips"/>

    <AppPopUp v-if="showPopup"/>

    <AppFooterMain/>

</template>
