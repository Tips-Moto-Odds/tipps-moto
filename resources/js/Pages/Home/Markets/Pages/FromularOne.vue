<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {subscribeToPush} from "@/HelperFunctions/SubscriberFunction.js";
import ParticipantsOdds from "@/Pages/Home/Markets/Components/ParticipantsOdds.vue";

const props = defineProps(['tips', 'yesterdaysTips', 'canViewFreeTips']);

const participants = [];

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

    <ParticipantsOdds
        sport-name="Formula One"
        event-name="Italian Grand Prix 2025"
        :participants="participants"
    />

    <AppFooterMain/>
</template>
