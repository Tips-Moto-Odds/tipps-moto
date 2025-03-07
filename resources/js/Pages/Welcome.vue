<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import MainBanner from "@/AppComponents/MainBanner.vue";
import TodaysFreeTips from "@/AppComponents/TodaysFreeTips.vue";
import AppPopUp from "@/AppComponents/AppPopUp.vue";
import YesterdayFreeTips from "@/AppComponents/YesterdayFreeTips.vue";
import {ref} from 'vue';

const props = defineProps(['tips']);
const showYesterdayTips = ref(false);
const showPopup = ref(false);



</script>
<template>
    <Head>
        <title>Welcome</title>
    </Head>

    <Navigation/>

    <MainBanner/>

    <TodaysFreeTips :tips="tips ?? []"/>

    <YesterdayFreeTips v-if="showYesterdayTips" :tips="tips"/>

    <AppPopUp v-if="showPopup"/>

    <AppFooterMain/>

</template>
