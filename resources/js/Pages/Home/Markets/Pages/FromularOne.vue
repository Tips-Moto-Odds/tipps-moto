<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {subscribeToPush} from "@/HelperFunctions/SubscriberFunction.js";
import ParticipantsOdds from "@/Pages/Home/Markets/Components/ParticipantsOdds.vue";

const props = defineProps(['tips', 'yesterdaysTips', 'canViewFreeTips']);

const participants = [
    {
        "name": "McLaren",
        "nationality": "United Kingdom",
        "odds": 1.08
    },
    {
        "name": "Mercedes",
        "nationality": "Germany",
        "odds": 50.00
    },
    {
        "name": "Ferrari",
        "nationality": "Italy",
        "odds": 50.00
    },
    {
        "name": "Red Bull Racing",
        "nationality": "Austria",
        "odds": 100.00
    },
    {
        "name": "Alpine",
        "nationality": "France",
        "odds": 100.00
    },
    {
        "name": "Other",
        "nationality": "Various",
        "odds": 100.00
    },
    {
        "name": "Williams",
        "nationality": "United Kingdom",
        "odds": 100.00
    }
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

    <ParticipantsOdds
        sport-name="Formula One"
        event-name="Italian Grand Prix 2025"
        :participants="participants"
    />

    <AppFooterMain/>
</template>
