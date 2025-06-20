<script setup>
import {computed, defineEmits, defineProps, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    packageName: String,
    price: Number,
    tax: Number,
    phone: String,
    errorMessage: String,
    show: Boolean,
    balance: {
        default: 0
    }
});

const emit = defineEmits(["confirm", "cancel"]);
const paymentError = ref('')

// start toggle
const showTinyTransactionRefInput = false
const renderPopUp = false
// end toggle

// Compute total price
const totalPrice = computed(() => props.price + props.tax);

const confirmPyment = () => {
    let elem = document.getElementById('paymentConfirmation')
    let value = elem.value

    axios.post('/api/tinypesa/confirmPayment', {
        'transactionCode': value,
        'packageName': props.packageName,
    })
        .then((response) => {
            if (response.data.status) {
                Inertia.visit(route('profile.subscription'))
            } else {
                console.log(response.data.body);
                paymentError.value = response.data.message
            }
        })
        .catch((err) => {
            console.log("Error : " + err)
        })
}

const payWithAvailableBalance = () => {
    axios.post('/api/payWithAvailableBalance', {
        'packageName': props.packageName,
    })
        .then((response) => {
            if (response.data.status) {
                Inertia.visit(route('profile.subscription'))
            } else {
                alert(response.data.message)
            }
        })
        .catch((err) => {
            console.log("Error : " + err)
        })
}


</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-md w-96 p-4">
            <div class="flex border-b mb-4 border-black justify-between">
                <h2 class="text-2xl pb-1 font-bold">Purchase Package</h2>
                <div @click.prevent="emit('cancel')"
                     class="p-0 m-0 h-[20px] cursor-pointer w-[20px] rounded-[50%] flex items-center text-sm justify-center bg-red-500 text-white">
                    X
                </div>
            </div>

            <p class="text-gray-700 mb-4">
                You are about to purchase the <span class="font-bold">{{ packageName }}</span> package for:
            </p>

            <div class="flex justify-between py-2">
                <span>Package</span>
                <span class="inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">{{ price }}</p>
                </span>
            </div>

            <div class="flex justify-between border-b border-black py-2">
                <span>D.S.T. (TAX)</span>
                <span class="inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">{{ tax }}</p>
                </span>
            </div>

            <div class="flex justify-between mb-4 py-2">
                <span class="font-bold">TOTAL</span>
                <span class="font-bold inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">{{ totalPrice }}</p>
                </span>
            </div>

            <div>
                <ul class="p-0 m-0">
                    <li v-if="balance >= totalPrice" class="w-full rounded bg-gray-200 hover:bg-gray-300 mb-3 p-[10px]">
                        <button @click.prevent="payWithAvailableBalance" class="flex">
                            <p>Pay with available Balance:</p>
                            <p class="font-bold p-0 ml-2 w-auto">KSH {{ balance }}</p>
                        </button>
                    </li>
                    <li class="w-full rounded bg-gray-200 hover:bg-gray-300 mb-3 p-[10px]">
                        <a href="https://tinypesa.com/TipsMoto" target="_blank" class="block cursor-pointer "
                           style="text-decoration: none">
                            <div class="h-[50px] w-[140px] flex items-center">
                                <img class="max-w-[80px] max-h-[50px]"
                                     src="/storage/System/content/PaymentLogos/tiny-pesa-logo.png">
                                <p class="w-[200px] p-0 m-0 font-bold text-green-600">Tiny Pesa</p>
                            </div>
                        </a>
                    </li>
                    <li v-if="showTinyTransactionRefInput">
                        <p class="mb-2">Please enter the transaction reference code after payment to confirm</p>
                        <div class="mb-2">
                            <input class="mr-1 border-gray-400 rounded" value="TF50LV6ID6" id="paymentConfirmation">
                            <button @click.prevent="confirmPyment" class="rounded app-button px-3 py-2 !bg-green-400">
                                Confirm
                            </button>
                        </div>
                        <div v-if="paymentError">
                            <p class="text-sm text-red-500">{{ paymentError }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>
