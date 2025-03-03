<script setup>
import {Head} from '@inertiajs/inertia-vue3'
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {onMounted, reactive, ref, useAttrs} from "vue";
import PurchasePackageModal from "@/AppComponents/PurchasePackageModal.vue";

const props = defineProps(['packages'])
const attr = useAttrs()

if (attr.flash.success || attr.flash.error) {
    if (attr.flash.success) {
        alert(attr.flash.success)
    } else {
        alert(attr.flash.error)
    }
}

const scrollToDiv = () => {
    // Get the URL
    const url = window.location.href;

    // Extract the fragment identifier (part after the hash)
    const hash = url.split('#')[1];

    // Find the element with the corresponding ID
    const targetElement = document.getElementById(hash);

    if (targetElement) {
        // Scroll to the element smoothly
        targetElement.scrollIntoView({behavior: 'smooth'});
        // Calculate the scroll position after scrolling to the element
        const scrollTop = window.scrollY - 100;

        // Scroll to the calculated position
        window.scrollTo({top: scrollTop, behavior: 'smooth'});
    }
}


const form = useForm({
    id: null,
    package: null,
    phone: usePage().props.auth?.user?.phone,
})
const showPaymentValue = ref(false)
const flashMessage = ref('')

const showDisplay = reactive({
    price: 0,
    tax: 0
})

function handleSubscriptionResponse() {

}

function confirmPayment() {
    form.post(route('dashboard.transactions.subscribe'), {
        onSuccess: (data) => {
            if (data?.props?.flash?.success) {
                alert(data?.props?.flash?.success);
            } else if (data?.props?.flash?.error) {
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

// function popUpPackageSelection(selection) {
//     form.id = selection.id;
//     form.package = selection.name
//     showDisplay.price = parseFloat(selection.price)
//     showDisplay.tax = parseFloat(selection.tax)
//     togglePaymentShow()
// }

function togglePaymentShow() {
    if (usePage().props.auth.user == null) {
        window.location.href = '/login';
    } else {
        showPaymentValue.value = !showPaymentValue.value
    }
}

onMounted(() => {
    scrollToDiv()
})
</script>

<template>
    <Head>
        <title>Tips</title>
    </Head>
    <div v-if="showPaymentValue" class="w-[100vw] h-[100vh] bg-black/50 flex items-center justify-center" style="z-index:30000;position:fixed; top: 0; left: 0; right: 0; bottom: 0;">
        <PurchasePackageModal
            :show="showPaymentValue"
            :packageName="form.package"
            :price="showDisplay.price"
            :tax="showDisplay.tax"
            :phone="form.phone"
            :errorMessage="form.errors.phone"
            @update:phone="form.phone = $event"
            @confirm="confirmPayment"
            @cancel="showPaymentValue = false"
        />
    </div>
    <Navigation/>
    <section class="px-[20px]">
        <div id="ftp" class="container mb-[20px] main-card-container p-[10px] bg-black rounded">
            <h1 class="text-center py-[20px]">Full-Time Scores</h1>
            <p class="px-[30px] mb-[30px] text-center">Full-Time Scores tips involve inferring the likely outcome of a match at the end of regular playing time. Whether it's a thrilling 2-1 victory or
                a
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
        <div id="jp" class="container mb-[20px] main-card-container p-[10px] bg-black rounded">
            <h1 class="text-center py-[20px]">Jackpot Tips</h1>
            <p class="px-[30px] mb-[30px] text-center">Jackpot Tips involve inferring the outcomes of a series of matches, typically 13-20 fixtures. These are high-stakes picks that require precision
                and
                comprehensive analysis. Tips Moto combines expert opinions, advanced algorithms, and statistical modeling to maximize your chances of hitting the jackpot, making even the toughest
                predictions more approachable.</p>
            <div class="container flex flex-col md:flex-row justify-content-between gap-2 mb-[20px] mx-auto rounded">
                <div class="bg-gray-50 w-full md:w-1/2 rounded overflow-hidden">
                    <img @click.prevent="popUpPackageSelection(packages[4])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/sport_pesa_mega_jackpot.png">
                </div>
                <div class="w-full md:w-1/2  flex flex-col rounded gap-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="rounded bg-gray-400 w-100 overflow-hidden">
                            <img @click.prevent="popUpPackageSelection(packages[7])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mozzart_weekly_jackpot.png">
                        </div>
                        <div class="rounded bg-gray-400 w-100 overflow-hidden">
                            <img @click.prevent="popUpPackageSelection(packages[6])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mozzart_daily_jackpot.png">
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row h-50 gap-2">
                        <div class="w-100 overflow-hidden  md:h-[100%] rounded bg-gray-400 grid place-items-center">
                            <img @click.prevent="popUpPackageSelection(packages[5])" class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid_week_jackpot_prediction.png">
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

