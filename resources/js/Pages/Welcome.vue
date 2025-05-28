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

onMounted(() => {
    timePopUp();
});

// navigator.serviceWorker.ready.then(async registration => {
//     const subscription = await registration.pushManager.getSubscription();
//     if (!subscription) {
//         await subscribeToPush();
//     }
// });

function calculateProfit() {
    // Get input values
    const budget = parseFloat(document.getElementById('starting-budget').value);
    const stake = parseFloat(document.getElementById('stake-per-bet').value);
    const days = parseInt(document.getElementById('time-period').value);
    const packagePrice = parseFloat(document.getElementById('package-price').value);
    const accuracy = parseFloat(document.getElementById('accuracy-rate').value) / 100;

    // Default odds (can be adjusted dynamically if needed)
    const odds = 2.0;

    // Calculate total bets and winning bets
    const totalBets = days;
    const winningBets = totalBets * accuracy;

    // Calculate total winnings and profit
    const winnings = winningBets * stake * odds;
    const spent = totalBets * stake;
    const profit = winnings - packagePrice;

    // Display result
    document.getElementById('result').innerHTML = `
                Estimated Profit: <strong>KES ${profit.toFixed(2)}</strong><br>
                Total Winnings: <strong>KES ${winnings.toFixed(2)}</strong><br>
                Total Spent (Including Package): <strong>KES ${(spent + packagePrice).toFixed(2)}</strong>
            `;
}

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

