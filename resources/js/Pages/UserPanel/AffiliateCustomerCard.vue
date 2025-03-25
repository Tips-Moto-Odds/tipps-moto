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
            <h6 class="mb-[20px] text-center">Available Balance</h6>
            <div class="mb-[20px] rounded-sm flex flex-col items-center justify-center bg-[#433F3F]" style="box-shadow: inset 0 4px 6px rgba(0,0,0,0.3)">
                <h1 class="pt-[10px] mb-[20px]">KES {{ affiliate.balance }}</h1>
                <div class="pb-[5px] flex gap-x-2">
                    <div class="w-[20px] h-[20px]">
                        <i class="bi bi-arrow-down"></i>
                    </div>
                    <p>Withdraw</p>
                </div>
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
            <button @click="joinProgram" class="btn btn-primary">Join the affiliate Program</button>
        </div>
    </section>
</template>
