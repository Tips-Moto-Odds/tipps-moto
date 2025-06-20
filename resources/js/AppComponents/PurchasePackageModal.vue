<script setup>
import {computed, defineEmits, defineProps, ref, watch} from 'vue'

const props = defineProps({
    packageName: String,
    price: Number,
    tax: Number,
    phone: String,
    errorMessage: String,
    show: Boolean,
    balance: {default: 0}
})

const emit = defineEmits(['confirm', 'cancel'])

const phoneNumber = ref(props.phone)
watch(() => props.phone, newVal => {
    phoneNumber.value = newVal
})

const totalPrice = computed(() => props.price + props.tax)

const confirmPayment = () => {
    emit('confirm', {
        phoneNumber: phoneNumber.value,
    })
}

</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-md w-96 p-4">
            <div class="flex justify-between border-b border-black mb-4">
                <h2 class="text-2xl font-bold pb-1">Purchase Package</h2>
                <button @click.prevent="emit('cancel')"
                        class="w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-sm">X
                </button>
            </div>

            <p class="mb-4 text-gray-700">
                You are about to purchase the <span class="font-bold">{{ packageName }}</span> package for:
            </p>

            <div class="flex justify-between py-2">
                <span>Package</span>
                <span class="inline-flex"><p>KES</p><p class="w-[50px] text-right">{{ price }}</p></span>
            </div>

            <div class="flex justify-between border-b border-black py-2">
                <span>D.S.T. (TAX)</span>
                <span class="inline-flex"><p>KES</p><p class="w-[50px] text-right">{{ tax }}</p></span>
            </div>

            <div class="flex justify-between py-2 mb-4 font-bold">
                <span>TOTAL</span>
                <span class="inline-flex"><p>KES</p><p class="w-[50px] text-right">{{ totalPrice }}</p></span>
            </div>

            <div class="mb-4">
                <p class="mb-[10px]">Enter you M-Pesa Phone number to receiver the payment request</p>
                <div class="flex items-center mb-2">
                    <input v-model="phoneNumber" type="text" class="rounded my-1 border-gray-400 p-2"
                           placeholder="7.....">
                </div>
                <span class="text-sm text-red-400">{{ errorMessage }}</span>
            </div>

            <div class="flex justify-between space-x-2">
                <button @click="confirmPayment" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded">
                    Confirm
                </button>
                <button @click="emit('cancel')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</template>
