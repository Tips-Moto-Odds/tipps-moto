<script setup>
import {Head} from '@inertiajs/inertia-vue3'
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {applyBackGroundOrange} from "@/HelperFunctions/appFunctions.js";
import Packages from "@/Pages/Home/Packages.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, reactive, ref, useAttrs} from "vue";

const props = defineProps(['packages'])
const attr = useAttrs()

if (attr.flash.success || attr.flash.error) {
    if (attr.flash.success){
        alert(attr.flash.success)
    }else {
        alert(attr.flash.error)
    }
}


const form = useForm({
    id:null,
    package: null,
    phone: '0719445697'
})
const showPaymentValue = ref(false)
const flashMessage = ref('')

const showDisplay = reactive({
    price:0,
    tax:0
})

function handleSubscriptionResponse(){

}

function confirmPayment() {
    form.post(route('dashboard.transactions.subscribe'), {
        onSuccess: (data) => {
            if (data?.props?.flash?.success) {
                alert(data?.props?.flash?.success);
            }else if (data?.props?.flash?.error) {
                alert(data?.props?.flash?.error);
            }

            const pollingInterval = 5000; // Adjust as needed (milliseconds)
            const maxPollingTime = 60000; // Maximum polling time (1 minute in milliseconds)
            let isPolling = true;
            let pollingStartTime = Date.now(); // Record when polling started

            const pollForUpdates = async () => {
                if (!isPolling) {
                    return;
                }

                const elapsedTime = Date.now() - pollingStartTime;
                if (elapsedTime >= maxPollingTime) {
                    console.log('Polling timed out.');
                    isPolling = false;
                    // Optionally display a message to the user about the timeout
                    alert("Payment confirmation is taking longer than expected. Please check your transaction history or contact support.");
                    return; // Stop polling
                }

                try {
                    const response = await fetch(route('dashboard.transactions.poll'), {
                        method: 'GET',
                    });

                    if (!response.ok) {
                        throw new Error(`API request failed with status ${response.status}`);
                    }

                    const updatedData = await response.json();

                    if (updatedData?.paymentConfirmed) {
                        alert('Payment confirmed!');
                        isPolling = false;
                    } else {
                        console.log('Payment not confirmed yet. Polling again...');
                    }
                } catch (error) {
                    console.error('Error polling for updates:', error);
                } finally {
                    if (isPolling) {
                        setTimeout(pollForUpdates, pollingInterval);
                    }
                }
            };

            // pollForUpdates();
        },
    });
}

function popUpPackageSelection(selection) {
    form.id = selection.id;
    form.package = selection.name
    showDisplay.price = parseFloat(selection.price)
    showDisplay.tax = parseFloat(selection.tax)
    togglePaymentShow()
}

function togglePaymentShow() {
    showPaymentValue.value = !showPaymentValue.value
}
</script>

<template>
    <Head>
        <title>Tips</title>
    </Head>
    <div v-if="showPaymentValue" class="w-[100vw] h-[100vh] bg-black/50 flex items-center justify-center" style="z-index:30000;position:fixed; top: 0; left: 0; right: 0; bottom: 0;">
        <div class="w-[320px] rounded-[12px] shadow p-[10px]  bg-white">
            <div class="flex m-0 p-0 items-center justify-between">
                <h5 class="p-0 m-0">Purchase Package</h5>
            </div>
            <hr class="my-[10px] p-0">
            <div class="text-sm mb-[5px] rounded-[16px]">
                <p class="mb-[10px]">You are about to Purchase <strong>{{ form.package }} package</strong> for:</p>
                <div>
                    <ul class=" p-0 m-0">
                        <li class="flex items-center justify-between">
                            <label>{{form.package}} package</label>
                            <p class=" p-0 m-0">Ksh {{showDisplay.price}}</p>
                        </li>
                        <li class="flex items-center justify-between">
                            <label>D.S.T (TAX)</label>
                            <p class=" p-0 m-0">Ksh {{ showDisplay.tax }}</p>
                        </li>
                    </ul>
                    <hr class=" p-0 mb-[10px] my-0">
                    <div class="mb-[20px] py-[10px] flex justify-between">
                        <p class="font-bold">Total</p>
                        <p class="font-bold">Ksh {{ showDisplay.tax + showDisplay.price }}</p>
                    </div>
                </div>
                <div class="mb-[20px]">
                    <label>Please enter your m-pesa phone number to complete purchase.</label>
                    <input v-model="form.phone" class="h-[30px] px-[5px] w-full rounded-sm m-0">
                    <p class="text-red-500">{{form.errors.phone}}</p>
                </div>
            </div>
            <ul class="w-full flex items-center justify-between m-0 p-0">
                <li class="bg-green-600 w-[100px] text-center py-[5px] rounded text-white" @click.prevent="confirmPayment">Confirm</li>
                <li class="bg-red-600 w-[100px] text-center py-[5px] rounded text-white" @click.prevent="togglePaymentShow">Cancel</li>
            </ul>
        </div>
    </div>
    <Navigation/>
    <section class="px-[20px]">
        <div class="container mb-[20px] main-card-container p-[10px] bg-black rounded">
            <h1 class="text-center py-[20px]">Full-Time Scores</h1>
            <p class="px-[30px] mb-[30px] text-center">Full-Time Scores tips involve inferring the likely outcome of a match at the end of regular playing time. Whether it's a thrilling 2-1 victory or a
                close 0-0 draw, Tips Moto delivers meticulously analyzed forecasts . Our team of experts leverages in-depth statistics, team form, and match-day factors to offer you high-probability
                outcomes, ensuring you bet with confidence.</p>
            <div class="mb-[20px] flex gap-3 md:flex-row items-center justify-center py-[20px]">
                <div class="flex justify-center items-center max-h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[0])" src="storage/System/content/Tips/Banners/daily_tips.png">
                </div>
                <div class="flex justify-center items-center max-h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[1])" src="storage/System/content/Tips/Banners/weekl_tips.png">
                </div>
            </div>
        </div>
        <div class="container mb-[20px] main-card-container p-[10px] bg-black rounded">
            <h1 class="text-center py-[20px]">Over & Under Markets</h1>
            <p class="px-[30px] mb-[30px] text-center">Overs and Unders
                This parameter focuses on forecasting whether the total goals scored in a match will be above or below a specified number (e.g., Over 2.5 or Under 2.5 goals). At Tips Moto, we provide
                data-driven insights into team scoring trends, head-to-head records, and defensive strengths, helping you make informed decisions for this highly popular betting market.</p>
            <div class="mb-[20px] flex gap-3 md:flex-row  items-center justify-center">
                <div class="flex justify-center items-center max-h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[2])" src="storage/System/content/Tips/Banners/daily_over_under.png">
                </div>
                <div class="flex justify-center items-center max-h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[3])" src="storage/System/content/Tips/Banners/weekly_over_under.png">
                </div>
            </div>
        </div>
        <div class="container mb-[20px] main-card-container p-[10px] bg-gray-600 rounded">
            <h1 class="text-center py-[20px]">Jackpot Tips</h1>
            <p class="px-[30px] mb-[30px] text-center">Jackpot Tips involve inferring the outcomes of a series of matches, typically 13-20 fixtures. These are high-stakes picks that require precision and
                comprehensive analysis. Tips Moto combines expert opinions, advanced algorithms, and statistical modeling to maximize your chances of hitting the jackpot, making even the toughest
                predictions more approachable.</p>
            <div class="container flex flex-col md:flex-row justify-content-between gap-2 mb-[20px] mx-auto rounded">
                <div class="bg-gray-50 w-full md:w-1/2 rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[4])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/sport_pesa_mega_jackpot.png">
                </div>
                <div class="w-full md:w-1/2  flex flex-col rounded gap-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="rounded bg-gray-400 w-100 overflow-hidden">
                            <img @click.prevent="popUpPackageSelection(packages[5])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mozzart_daily_jackpot.png">
                        </div>
                        <div class="rounded bg-gray-400 w-100 overflow-hidden">
                            <img @click.prevent="popUpPackageSelection(packages[6])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mozzart_weekly_jackpot.png">
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row h-50 gap-2">
                        <div class="w-100 overflow-hidden  md:h-[100%] rounded bg-gray-400 grid place-items-center">
                            <img @click.prevent="popUpPackageSelection(packages[7])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid_week_jackpot_prediction.png">
                        </div>
                        <div class="w-100 overflow-hidden md:h-[100%] rounded bg-gray-400 grid place-items-center">
                            <img @click.prevent="popUpPackageSelection(packages[8])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/odi_weekly_jackpot.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <app-footer-main/>
</template>

<style scoped lang="scss">
.main-card-container {
    h1 {
        @apply text-white;
    }

    p {
        @apply text-white
    }
}

.footer {
    section:first-of-type {
        div {
            @apply p-[10px] w-[200px];

            li {
                @apply text-black;
            }
        }
    }
}
</style>

