<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {subscribeToPush} from "@/HelperFunctions/SubscriberFunction.js";
import CommingSoon from "@/Pages/Home/Markets/Components/CommingSoon.vue";

const props = defineProps(['tips', 'yesterdaysTips', 'canViewFreeTips']);

const participants = [
    {name: "Max Verstappen", odds: 1.85},
    {name: "Lewis Hamilton", odds: 2.10},
    {name: "Charles Leclerc", odds: 3.00},
    {name: "Lando Norris", odds: 5.25},
    {name: "Fernando Alonso", odds: 6.80},
];

navigator.serviceWorker.ready.then(async registration => {
    const subscription = await registration.pushManager.getSubscription();
    if (!subscription) {
        await subscribeToPush();
    }
});

</script>

<template>
    <Head><title>Welcome</title></Head>

    <Navigation/>

    <CommingSoon></CommingSoon>

    <AppFooterMain/>
</template>
