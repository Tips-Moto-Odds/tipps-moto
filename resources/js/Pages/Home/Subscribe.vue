<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import PriceCard from "@/AppComponents/PriceCard.vue";
import {reactive} from "vue";

const props = defineProps(['package', 'is_authenticated'])

const payment_alert = reactive({
    heading: "Payment Processing"
})

const confirm_payment = () => {
    let element = $('.payment_overlay')
    element.fadeIn()
}

const close_processing = () => {
    let element = $('.payment_overlay')
    element.fadeOut()
}

const payment_successful = () => {
    payment_alert.heading = "Payment Successful"
    // Your success logic goes here
    // For demonstration purposes, we will close the overlay after 5 seconds
    setTimeout(() => {
        close_processing()
    }, 15000)
}

//run after 5sec
setTimeout(() => {
    payment_successful()
}, 5000)

</script>

<template>
    <HomeLayout>
        <teleport to="body">
            <div class="payment_overlay bg-gray-600">
                <div class="flex justify-center items-center h-[100vh]">
                    <div class="w-[200px] h-[200px] bg-gray-600 text-white rounded mx-auto shadow-md">
                        <h2 class="text-center font-bold py-[20px]">{{payment_alert.heading}}</h2>
                        <div class="w-[40px] h-[40px] m-auto !mb-[40px]">
                            <img id="rotate-processing" width="50" height="50" src="https://img.icons8.com/ios/7DF247/loading.png" alt="loading"/>
                        </div>
                        <div class="flex items-center justify-center">
                            <button class="bg-red-400 px-[10px] py-[3px] rounded" @click.prevent="close_processing">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>
        <div class="container py-[40px] flex flex-wrap px-[10px] justify-center gap-3">
            <div class="py-[20px] list-none">
                <price-card :subscription="package" :displaySubscription="false"></price-card>
            </div>
            <div class="bg-gray-500 rounded text-white w-[500px]  p-[20px]">
                <h2 class="font-bold my-[10px]">Order Details</h2>
                <hr class="mb-[10px]  mt-[10px]" style="border: lightgrey 1px solid">
                <div class="flex justify-between">
                    <p>Sub Total</p>
                    <p>Sub Total</p>
                </div>
                <hr class="mb-[10px] mt-[10px]" style="border: lightgrey 1px solid">
                <div class="flex justify-between">
                    <p>Tax</p>
                    <p>Ksh 100.00</p>
                </div>
                <hr class="mb-[10px] mt-[10px]" style="border: lightgrey 1px solid">
                <div class="flex justify-between mb-[50px]">
                    <p class="font-bold">Total</p>
                    <p>Ksh 100.00</p>
                </div>
                <div class="mb-[20px]">
                    <h2>Payment Method:</h2>
                    <select class="rounded block w-full text-gray-600">
                        <option value="mpesa">M-Pesa</option>
                    </select>
                </div>
                <div>
                    <p>Mpesa Phone Number</p>
                    <input type="text" class="rounded block w-full text-gray-600">
                </div>
                <div class="py-[10px]">
                    <button class="btn btn-primary block text-center bg-blue-500 rounded w-full py-[10px]" @click.prevent="confirm_payment">CHECKOUT</button>
                </div>

            </div>
        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.payment_overlay{
    display: none;
    background-color: rgba(0,0,0,0.5);
    position: fixed;
    z-index: 20000;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
}

#rotate-processing {
    animation: rotate 2s linear infinite;
    transform-origin: center;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

</style>
