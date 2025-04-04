<script setup>
import PageHeading from "@/Pages/Home/components/PageHeading.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

const list_items = [
    {
        heading: "Affiliate Program Terms of Service",
        content: "Thank you for your interest in the Tips Moto Affiliate Program. By choosing to join, you acknowledge that you have read, understood, and agreed to these Terms of Service. These terms operate in addition to our general Terms and Conditions and Privacy Policy."
    },
    {
        heading: "Eligibility & Joining",
        content: "Any registered user on Tips Moto is automatically eligible to join the Affiliate Program. No separate form is required. By clicking the “Join Now” button, you activate your affiliate status and agree to these Terms.\n\nAll necessary referral tracking and payment information will be drawn directly from your existing account in our system."
    },
    {
        heading: "Referral Commissions",
        content: "Affiliates earn a 10% commission on every successful subscription or purchase made through their unique affiliate link.\n\nCommission totals are calculated based on actual payments received, excluding taxes or transaction-related fees. Each referred user is counted only once."
    },
    {
        heading: "Payments & Withdrawals",
        content: "Payouts are available on request, and the minimum payout threshold is KES 200.\n\nA small service fee will be deducted from each withdrawal to facilitate the transfer process.\n\nAll payment requests are reviewed and processed manually, and we reserve the right to verify account details before releasing any funds."
    },
    {
        heading: "Transparency & Reporting",
        content: "As an affiliate, you will have access to a dashboard that shows:",
        list_item: [
            "The number of users you’ve referred",
            "Your total earned commission",
            "Your withdrawal history"
        ]
    },
    {
        heading: "",
        content: "For privacy and compliance reasons, you will not have access to detailed information about referred users beyond their usernames and your earnings summary."
    },
    {
        heading: "Ethical Promotion Guidelines",
        content: "You are free to share your affiliate link via social media, websites, messaging apps, or other digital platforms. However, we ask that all promotion is done ethically and in line with our brand values. You may not:",
        list_item: [
            "Pretend to be Tips Moto or misrepresent your role",
            "Use spam or unsolicited messages to promote your link",
            "Engage in deceptive, fraudulent, or misleading behavior"
        ]
    },
    {
        heading: "",
        content: "Violations of these guidelines may result in termination from the program."
    },
    {
        heading: "Termination",
        content: "We reserve the right to suspend or terminate your affiliate access at any time—especially in cases of misuse, fraud, or violation of these terms.\n\nYou may also leave the program at any time by notifying us.\n\nIf your account is terminated with pending commissions below the minimum threshold or in violation of policy, we reserve the right to withhold payment."
    },
    {
        heading: "Changes to Terms",
        content: "These Affiliate Program Terms may be updated periodically. Any changes will be posted on this page and will take effect immediately. Continued participation implies acceptance of the revised terms."
    },
    {
        heading: "Contact Information",
        content: "For any questions or concerns about the Affiliate Program or payments, feel free to reach us at:\n📧 info@tipsmoto.co.ke"
    },
];
</script>


<template>
    <Head>
        <title>About Us</title>
    </Head>
    <Navigation/>
    <div class="container content text-white text-justify text-sm bg-gray-500] !p-[10px] bg-black rounded mb-[20px]">
        <h1 class="font-bold mb-[20px]">TERMS OF SERVICE</h1>
        <h2 class="mb-[20px] text-sm font-[200]"> By using our website, you acknowledge that you have read, understood, and agreed to these Terms and
            Conditions. Thank you for choosing Trendy Tips!</h2>
        <ol class="list-decimal px-[25px]">
            <li v-for="item in list_items" class="mb-[20px]">
                <h4 class="mb-[20px] font-bold text-[22px]">{{ item.heading }}</h4>
                <p class="font-[200] text-sm">{{ item.content }}</p>
                <ul class="px-[30px] list-disc" v-for="item_x in item.list_item">
                    <li>{{ item_x }}</li>
                </ul>
                <hr>
            </li>
        </ol>
    </div>
    <app-footer-main/>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px];
}
#main-site-menu {
    position: fixed;
    right: 100%;
    transition: all ease 250ms;

    a {
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active {
        @apply text-orange-400;
    }
}
</style>
