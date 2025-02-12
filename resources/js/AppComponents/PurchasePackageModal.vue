<script setup>
import { defineProps, defineEmits, computed } from "vue";

const props = defineProps({
    packageName: String,
    price: Number,
    tax: Number,
    phone: String,
    errorMessage: String,
    show: Boolean,
});

const emit = defineEmits(["confirm", "cancel"]);

// Compute total price
const totalPrice = computed(() => props.price + props.tax);
</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-md w-96 p-4">
            <h2 class="text-2xl pb-1 font-bold border-b border-black mb-4">Purchase Package</h2>

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

            <div class="flex justify-between py-2">
                <span class="font-bold">TOTAL</span>
                <span class="font-bold inline-flex">
                    <p>KES</p>
                    <p class="w-[50px] text-right">{{ totalPrice }}</p>
                </span>
            </div>

            <p class="text-gray-700 text-sm mt-4">
                Please enter your <span class="font-bold">M-Pesa</span> phone number to complete the purchase:
            </p>

            <input
                type="text"
                placeholder="Phone Number"
                class="w-full border rounded-md p-2 mt-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                :value="phone"
                @input="$emit('update:phone', $event.target.value)"
            />

            <p class="text-red-500">{{ errorMessage }}</p>

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
