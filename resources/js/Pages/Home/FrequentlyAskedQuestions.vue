<script setup>
import { Head } from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

const faqs = [
    {
        question: "How much do your services cost?",
        answer: `
        <ul class='list-disc pl-[20px]'>
            <li><strong>Full-Time Scores:</strong>
                <ul class='list-circle pl-[20px]'>
                    <li>KES 99/- per day for 15 games.</li>
                    <li>KES 599/- per week for 17 games daily.</li>
                </ul>
            </li>
            <li><strong>Over & Under Markets:</strong>
                <ul class='list-circle pl-[20px]'>
                    <li>KES 29/- daily for 5 games.</li>
                    <li>KES 199/- weekly for 7 games daily.</li>
                </ul>
            </li>
            <li><strong>Jackpot Tips:</strong>
                <ul class='list-circle pl-[20px]'>
                    <li>Daily: Mozzart @ KES 39/- per jackpot.</li>
                    <li>Midweek: Sportpesa @ KES 49/- per jackpot.</li>
                    <li>Weekly: Odibet & Mozzart @ KES 29/- each.</li>
                    <li>Mega Jackpot: Sportpesa @ KES 49/-.</li>
                    <li>Segmented Jackpots: 3 games @ KES 15/-.</li>
                </ul>
            </li>
        </ul>`
    },
    {
        question: "How do I pay?",
        answer: "Payments are made via <strong>M-Pesa</strong>. Once payment is confirmed, tips will be sent to your registered Tips Moto account."
    },
    {
        question: "How do I receive tips?",
        answer: "After payment, tips are delivered in real time through the Tips Moto website and will be accessible through your dashboard after logging in."
    },
    {
        question: "Are the tips guaranteed?",
        answer: "While we strive for high accuracy based on expert analysis, betting involves risk. We do not guarantee 100% success but aim to increase your chances of winning."
    },
    {
        question: "Can I get free tips?",
        answer: "Occasionally, we may run promotions such as free trial tips for new users or discounted tips for existing users. Follow our social media pages to catch these offers."
    },
    {
        question: "What time are tips shared?",
        answer: `
        <ul class='list-disc pl-[20px]'>
            <li><strong>Full-Time Scores & Over/Under Tips:</strong> Shared daily by 11:00 AM.</li>
            <li><strong>Jackpot Tips:</strong> Shared at least 8 hours before the jackpot closes.</li>
        </ul>`
    },
    {
        question: "How do I contact customer support?",
        answer: "You can reach us through <strong>Email:</strong> tipsmoto2023@gmail.com"
    }
];
</script>

<template>
    <Head>
        <title>FAQs</title>
    </Head>
    <Navigation />
    <div class="md:container mx-[20px] md:mx-auto md:flex md:gap-2.5 bg-black rounded-[18px] mb-[20px]">
        <div class="container text-white text-sm  p-[30px]">
            <div class="text-white mb-[30px]">
                <h1 class="text-[26px] font-bold">Frequently Asked Questions (FAQs)</h1>
            </div>
            <div class="faq-list">
                <div v-for="(faq, index) in faqs" :key="index" class="faq-item">
                    <h4 class="font-bold text-[22px] mb-[10px]">{{ faq.question }}</h4>
                    <p v-html="faq.answer" class="text-gray-200"></p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <AppFooterMain />
</template>

<style scoped lang="scss">
.faq-list {
    @apply mb-[40px];
}

.faq-item {
    @apply p-[15px] rounded-lg shadow-lg;
}
</style>
