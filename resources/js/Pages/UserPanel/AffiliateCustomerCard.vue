<script setup>

import {router} from "@inertiajs/vue3";

const props = defineProps(['affiliate'])

const copyReferralLink = () => {
    const link = props.affiliate.referral_link;

    navigator.clipboard.writeText(link)
        .then(() => {
            alert('✅ Link copied to clipboard');
        })
        .catch(err => {
            alert('❌ Failed to copy link');
        });
};

const joinProgram = () => {
    router.post(route('affiliate.join'), {}, {
        onSuccess: () => {
            alert('✅ Successfully joined the affiliate program');
            router.reload()
        },
        onError: (errors) => {
            alert('❌ Error joining affiliate program');
        },
    });
};


</script>
<template>
    <section>
        <div v-if="affiliate  && affiliate.affiliate_code" class="bg-black p-[20px] mb-[10px] rounded-lg ">
            <h2 class="mb-[10px]">Affiliate</h2>
            <hr class="border border-white bg-white"/>
            <h6 class="mb-[20px] text-center">Available Balance</h6>
            <div class="mb-[20px] rounded-sm flex flex-col items-center justify-center bg-[#433F3F]" style="box-shadow: inset 0 4px 6px rgba(0,0,0,0.3)">
                <h1 class="pt-[10px] mb-[20px]">KES {{ affiliate.balance }}</h1>
                <button class="pb-[5px] flex gap-x-2" type="button" @click="$emit('openWithdrawModal')">
                    <div class="w-[20px] h-[20px]">
                        <i class="bi bi-arrow-down"></i>
                    </div>
                    <p>Withdraw</p>
                </button>
            </div>
            <div class="flex mb-[20px] justify-between">
                <section>
                    <h6>Total Referrals</h6>
                    <h5>{{ affiliate.referrals }}</h5>
                </section>
                <section class="text-right">
                    <h6>Total Earnings</h6>
                    <h5>{{ affiliate.earned }}</h5>
                </section>
            </div>
            <div class="flex flex-col text-center justify-between">
                <h6>Referral code</h6>
                <div class="flex gap-x-2 justify-center items-center">

                    <a :href="affiliate.referral_link" class="text-white">{{ affiliate.affiliate_code }}</a>
                    <div class="w-[20px] h-[20px]" @click="copyReferralLink()">
                        <i class="bi bi-copy"></i>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="bg-black p-[20px] mb-[10px] rounded-lg ">
            <h2 class="mb-[10px]">Affiliate</h2>
            <hr class="border border-white bg-white"/>
            <div>
                <p class="mb-2">
                    You're invited to join our Affiliate Program!
                    Earn a 10% commission on every successful referral you make.
                </p>

                <p class="mb-2">
                    Before applying, please take a moment to read our <a :href="route('affiliateTermsAndConditions')">Terms and Conditions</a>.
                    Only applicants who’ve reviewed the terms will be eligible to join.
                </p>

                <p class="mb-5">
                </p>
                <button @click="joinProgram" class="btn mb-4 block btn-primary">Join the affiliate Program</button>

                <p>
                    We look forward to having you on board!
                </p>
            </div>
        </div>
    </section>
</template>
