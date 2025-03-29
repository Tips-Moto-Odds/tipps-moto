<script setup>
import {defineProps, defineEmits, computed} from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps([
    'amount',
    'phone',
    'password',
    'phoneError',
    'passwordError',
    'amountError',
    'show'
]);

const emit = defineEmits(["confirm", "cancel",'update:amount', 'update:password', 'update:phone']);

// const totalPrice = computed(() => props.price + props.tax);
</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-md w-96 p-4">
            <h2 class="text-2xl pb-1 font-bold border-b border-black mb-4">Withdraw</h2>

            <p class="text-gray-700 mb-4">Enter the amount you would like to with draw</p>

            <div class="flex justify-between py-2">
                <span>Amount</span>
                <span class="inline-flex">
                    <p class="mr-2">KES</p>
                    <div class="border-b border-black  flex items-center">
                    <input type="number" class="max-w-[100px] h-5 border-none !outline-none"
                           :value="amount"
                           @input="$emit('update:amount', $event.target.value)"
                    />
                    </div>
                </span>
            </div>

            <div class="flex justify-between border-b border-black py-2">
                <span>Service Fee</span>
                <span class="inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">500</p>
                </span>
            </div>

            <div class="flex justify-between py-2">
                <span class="font-bold">TOTAL</span>
                <span class="font-bold inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">500</p>
                </span>
            </div>

            <p class="text-gray-700 text-sm mt-4">
                Please enter your <span class="font-bold">M-Pesa</span> phone number and your account password to complete the withdrawal request:
            </p>

            <input
                type="text"
                placeholder="Phone Number"
                class="w-full border rounded-md mb-1 p-2 mt-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                :value="phone"
                @input="$emit('update:phone', $event.target.value)"
            />
            <p class="alert-danger rounded mb-[20px] text-sm">{{phoneError}}</p>


            <input
                type="password"
                placeholder="Password"
                class="w-full border rounded-md p-2 mt-2 mb-1 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                :value="password"
                @input="$emit('update:password', $event.target.value)"
            />
            <p class="alert-danger rounded text-sm">{{passwordError}}</p>
            <div class="flex justify-between mt-6">
                <button
                    class="w-1/2 bg-green-500 text-white font-bold py-2 rounded-md mr-2 hover:bg-green-600 transition-transform"
                    @click="$emit('confirm')"
                >
                    CONFIRM
                </button>
                <button
                    class="w-1/2 bg-red-500 text-white font-bold py-2 rounded-md ml-2 hover:bg-red-600 transition-transform"
                    @click="$emit('cancel')"
                >
                    CANCEL
                </button>
            </div>
        </div>
    </div>
</template>
