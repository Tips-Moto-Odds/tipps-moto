<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import MainBanner from "@/AppComponents/MainBanner.vue";
import TodayFreeTips from "@/AppComponents/TodayFreeTips.vue";
import AppPopUp from "@/AppComponents/AppPopUp.vue";
import YesterdayFreeTips from "@/AppComponents/YesterdayFreeTips.vue";
import {onMounted, ref} from 'vue';
import {subscribeToPush} from "@/HelperFunctions/SubscriberFunction.js";

const props = defineProps(['tips','yesterdaysTips','canViewFreeTips']);

const showPopup = ref(true);

function timePopUp() {
    const cookieName = "popup_last_seen";
    const hours = 3;
    const now = new Date().getTime();

    function getCookie(name) {
        const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    function setCookie(name, value, hours) {
        const expiryDate = new Date();
        expiryDate.setTime(expiryDate.getTime() + (hours * 60 * 60 * 1000));
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expiryDate.toUTCString()}; path=/`;
    }

    const lastSeen = getCookie(cookieName);
    if (!lastSeen || now - parseInt(lastSeen) > hours * 60 * 60 * 1000) {
        showPopup.value = true;
        setCookie(cookieName, now.toString(), hours);
    } else {
        showPopup.value = false;
    }
}

onMounted(() => {
    timePopUp();
});

navigator.serviceWorker.ready.then(async registration => {
    const subscription = await registration.pushManager.getSubscription();
    if (!subscription) {
        await subscribeToPush();
    }
});

</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>

    <Navigation />

    <MainBanner/>

    <TodayFreeTips :tips="tips ?? []" :canViewFreeTips/>

    <YesterdayFreeTips v-if="yesterdaysTips.length > 0" :tips="yesterdaysTips"/>

    <AppPopUp v-if="showPopup"/>

    <AppFooterMain/>

</template>
