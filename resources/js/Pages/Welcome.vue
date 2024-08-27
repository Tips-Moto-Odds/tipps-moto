<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import TipDisplay from "@/Pages/TipDisplay.vue";
import {closeSideBar, openSideBar} from "@/HelperFunctions/modalControl.js";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import MpesaNumberInitiation from "@/Pages/MpesaNumberInitiation.vue";
import MpesaNumberProcessing from "@/Pages/MpesaNumberProcessing.vue";
import MpesaNumberSuccess from "@/Pages/MpesaNumberSuccess.vue";
import MpesaNumberError from "@/Pages/MpesaNumberError.vue";
import MatchHistory from "@/AppComponents/MatchHistory.vue";

const props = defineProps(['tips', 'upcoming'])
const active_tip = ref(null)
const mode = ref("initiating")
const userForm = useForm({
    user_number: "254719445697"
})

const CheckoutRequestID_ref = ref('')
const MerchantRequestID_ref = ref('')
let intervalId = null
let counter = 0

function purchaseTip(item) {
    active_tip.value = item
    let element = $('.right-panel').remove('hidden')
    element.css('z-index', '10000')
    openSideBar()
}

function closeSideBarAction() {
    console.log("closing")
    mode.value = 'initiating'
    closeSideBar()
    resetKeys()
}

async function initiateTransaction() {
    const {
        data: {
            ResponseCode,
            CheckoutRequestID,
            MerchantRequestID
        }
    } = await axios.post(route('initiateTransaction'), userForm);

    try {
        if (parseInt(ResponseCode) === 0) {
            mode.value = "processing";
            CheckoutRequestID_ref.value = CheckoutRequestID;
            MerchantRequestID_ref.value = MerchantRequestID;

            // Start the recursive checking process
            await checkPaymentStatus();
        } else {
            throw new Error('There was a problem while sending the Request. Please try again later');
        }
    } catch (error) {
        mode.value = "Error";
        console.log(error);
        stopInterval();
    }
}

function resetKeys() {
    active_tip.value = null
    CheckoutRequestID_ref.value = ''
    MerchantRequestID_ref.value = ''
    intervalId = null
    counter = 0
}

function stopInterval() {
    clearTimeout(intervalId);
    resetKeys()
}

async function checkPaymentStatus() {
    counter = counter + 1
    try {
        const {data: {request_status, order_status}} = await axios.post(route('checkTransactionStatus'), {
            CheckoutRequestID: CheckoutRequestID_ref.value,
            MerchantRequestID: MerchantRequestID_ref.value
        });

        if (request_status === 'completed') {
            if (order_status === 'successful') {
                console.log("Payment was successful");
                mode.value = 'confirm_payment';
                // stopInterval();
                return true;
            } else {
                throw new Error('Payment Not received. Canceling order!');
            }
        } else {
            if (counter > 5) {
                throw new Error('Payment Not received. Canceling order!');
            } else {
                intervalId = setTimeout(checkPaymentStatus, 3000);
            }
        }
    } catch (error) {
        mode.value = "Error";
    }
}


</script>

<template>
    <HomeLayout>
        <div class="right-panel fixed">
            <mpesa-number-initiation v-if="mode === 'initiating'" :active_tip :userForm
                                     @close-side-bar="closeSideBarAction" @initiate-transaction="initiateTransaction"/>
            <mpesa-number-processing v-else-if="mode === 'processing'" :active_tip :userForm
                                     @close-side-bar="closeSideBarAction" @initiate-transaction="initiateTransaction"/>
            <mpesa-number-success v-else-if="mode === 'confirm_payment'" :active_tip :userForm
                                  @close-side-bar="closeSideBarAction" @initiate-transaction="initiateTransaction"/>
            <mpesa-number-error v-else :active_tip :userForm @close-side-bar="closeSideBarAction"
                                @initiate-transaction="initiateTransaction"/>
        </div>

        <div
            class="h-[calc(100vh_-_80px)] mb-[40px] banner xl:max-w-[1200px] xl:mx-auto xl:mt-[10px] xl:rounded xl:overflow-hidden md:max-h-[400px]">
            <div class="w-full h-full flex flex-col items-center justify-center  px-[20px] md:flex-row ">
                <div class="md:w-1/2">
                    <img src="/storage/System/Icons/logo-dark.png" class="w-[100px] mb-[20px] md:hidden" alt="logo">
                    <h2 class="text-white text-[20px] mb-[30px] font-semibold text-center md:text-[30px] md:px-[20px] md:text-left">
                        Home of Premium League <br> betting tips</h2>
                    <p class="text-white px-[10px] mb-[10px] text-center text-[12px] md:text-[15px] md:px-[20px] md:text-left">
                        Get the latest winning tips from Tips moto and become an expert <br class="hidden md:block"> in
                        sports betting</p>
                </div>
                <div v-if="upcoming" class="container bg-gray-900 bg-red rounded text-white md:w-1/2">
                    <h3 class="text-center pt-[10px] mb-[20px] md:text-2xl md:mb-[0px]">Up Coming</h3>
                    <div
                        class="flex justify-around items-center mb-[20px] md:mb-[10px] md:h-[200px] md:max-w-[450px] mx-auto">
                        <div>
                            <div class="w-[80px] h-[80px] p-[10px] rounded bg-white">
                                <img class="h-full w-full object-contain" v-if="upcoming"
                                     :src="'/storage/System/TeamLogos/' + upcoming.home_logo" alt="image">
                            </div>
                        </div>
                        <div>
                            <p>VS</p>
                        </div>
                        <div>
                            <div class="w-[80px] h-[80px] bg-white rounded">
                                <img class="h-full w-full object-contain" v-if="upcoming"
                                     :src="'/storage/System/TeamLogos/' + upcoming.away_logo" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="text-white text-[14px] text-center mb-[10px]">
                        <p>May 1st 2024</p>
                        <p>12:00Pm</p>
                    </div>
                    <div class="flex justify-center mb-[10px]">
                        <a class="bg-orange-500 px-[30px] py-[10px] rounded" href="/">GET TIP</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="container app-panel p-[10px] rounded">
                <div class="app-panel-heading flex justify-center"><h1>TIPS MOTO BETTING TIPS</h1></div>
                <div class="content-area p-[10px] text-white text-sm">
                    <p class="mb-[30px] text-center">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Architecto assumenda autem beatae blanditiis dolor earum eligendi facere iste maiores
                        necessitatibus nesciunt nulla, omnis provident quos recusandae repudiandae ullam unde vel.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto assumenda autem beatae
                        blanditiis dolor earum eligendi facere iste maiores necessitatibus nesciunt nulla, omnis
                        provident quos recusandae repudiandae ullam unde vel.Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit. Architecto assumenda autem beatae blanditiis dolor earum eligendi facere iste
                        maiores necessitatibus nesciunt nulla, omnis provident quos recusandae repudiandae ullam unde
                        vel.
                    </p>
                </div>
            </div>

            <div class="container app-panel p-[10px] rounded mb-[20px] text-white">
                <div class="app-panel-heading flex justify-center mb-[20px]"><h1>TODAY'S FREE TIPS</h1></div>
                <ul class="mx-auto max-w-[800px] mb-[30px]">
                    <li v-for="tip in tips">
                        <tip-display :item="tip"></tip-display>
                    </li>
                </ul>
                <div class="flex">
                    <Link
                        :href="route('packages')"
                        class="inline-block mx-auto bg-orange-400 px-[30px] py-[4px] rounded-sm mb-[50px]">
                        GET MORE
                    </Link>
                </div>
            </div>

            <div class="container app-panel p-[10px] rounded mb-[20px]">
                <div class="app-panel-heading flex justify-center"><h1>PREVIOUS MATCHES</h1></div>
                <MatchHistory :tips/>
            </div>

        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.banner {
    background-image: url("/storage/app/public/System/banner.png");
    background-size: cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

</style>
