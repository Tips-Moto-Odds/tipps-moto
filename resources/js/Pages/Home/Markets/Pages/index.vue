<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {subscribeToPush} from "@/HelperFunctions/SubscriberFunction.js";
import Banner from "@/Pages/Home/Markets/Components/Banner.vue";
import SupportedMultiSportEvents from "@/Pages/Home/Markets/Components/SupportedMultiSportEvents.vue";

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

    <Banner/>

    <SupportedMultiSportEvents/>

    <!--    <ParticipantsOdds-->
    <!--        sport-name="Formula One"-->
    <!--        event-name="Italian Grand Prix 2025"-->
    <!--        :participants="participants"-->
    <!--    />-->

    <AppFooterMain/>
</template>
