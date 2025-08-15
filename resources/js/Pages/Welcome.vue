<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import MainBanner from "@/AppComponents/MainBanner.vue";
import TodayFreeTips from "@/AppComponents/TodayFreeTips.vue";
import AppPopUp from "@/AppComponents/AppPopUp.vue";
import YesterdayFreeTips from "@/AppComponents/YesterdayFreeTips.vue";
import {onMounted, ref} from 'vue';

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

const showBanner = ref(false);

onMounted(() => {
    // Only show banner if countdown not finished
    const targetTime = new Date();
    targetTime.setHours(19 + 3 + targetTime.getTimezoneOffset() / 60);
    targetTime.setMinutes(0);
    targetTime.setSeconds(0);
    targetTime.setMilliseconds(0);

    function updateCountdown() {
        const now = new Date();
        const diff = targetTime - now;

        if (diff < 0) {
            showBanner.value = false; // hide banner after launch
            return;
        }

        showBanner.value = true;
        const hours = Math.floor(diff / 1000 / 60 / 60);
        const minutes = Math.floor((diff / 1000 / 60) % 60);
        const seconds = Math.floor((diff / 1000) % 60);

        const countdownEl = document.getElementById('countdown');
        if (countdownEl) countdownEl.innerText = `${hours}h ${minutes}m ${seconds}s`;
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
});

// navigator.serviceWorker.ready.then(async registration => {
//     const subscription = await registration.pushManager.getSubscription();
//     if (!subscription) {
//         await subscribeToPush();
//     }
// });


</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <section v-if="showBanner" class="container">
        <div
            class="bg-gray-900 text-orange-400 py-4 px-6 flex flex-col md:flex-row items-center justify-between shadow-lg">
            <div class="text-center md:text-left">
                <h2 class="text-xl md:text-2xl font-bold mb-1">🚀 Stay Tuned!</h2>
                <p class="text-sm md:text-base">
                    A new Premier League, new design, free tips, and a whole new experience is coming!
                </p>
                <p class="mt-2 text-lg font-semibold">
                    Launching in <span id="countdown">Loading...</span>
                </p>
            </div>
        </div>
    </section>


    <Navigation />

    <MainBanner/>

    <TodayFreeTips :tips="tips ?? []" :canViewFreeTips/>

    <YesterdayFreeTips v-if="yesterdaysTips.length > 0" :tips="yesterdaysTips"/>

    <AppPopUp v-if="showPopup"/>

    <AppFooterMain/>

</template>

