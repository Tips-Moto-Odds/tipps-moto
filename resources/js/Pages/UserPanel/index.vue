<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import AffiliateCustomerCard from "@/Pages/UserPanel/AffiliateCustomerCard.vue";
import WithdrawalCard from "@/Pages/UserPanel/Components/WithdrawalCard.vue";
import {ref} from "vue";

const props = defineProps(['user', 'affiliate'])
const page = usePage()
const user = page?.props?.user
const showPaymentValue = ref(false)

const form = useForm({
    name: user.name,
    email: user.email,
    phone: user.phone,
})
const withdrawForm = useForm({
    amount: 0,
    phone: user.phone,
    password: null,
})

const updateUser = () => {
    form.patch(route('UpdateUser', [user.id]), {
        onSuccess: () => {
            console.log("done")
        },
    })
}

// const togglePaymentShow = () => showPaymentValue.value = !showPaymentValue.value
const togglePaymentShow = () => false

const confirmPayment = () => {
    withdrawForm.post(route('affiliate.withdraw'), {
        onSuccess: ({props}) => {
            alert(props?.flash?.success);
            togglePaymentShow()
        },
        onError: () => {

        }
    });
};

</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <div v-if="showPaymentValue" class="w-[100vw] h-[100vh] bg-black/50 flex items-center justify-center" style="z-index:30000;position:fixed; top: 0; left: 0; right: 0; bottom: 0;">
        <WithdrawalCard
            :show="showPaymentValue"

            v-model:amount="withdrawForm.amount"
            v-model:phone="withdrawForm.phone"
            v-model:password="withdrawForm.password"

            :amountError="withdrawForm.errors.amount"
            :phoneError="withdrawForm.errors.phone"
            :passwordError="withdrawForm.errors.password"

            @confirm="confirmPayment"
            @cancel="togglePaymentShow"
        />
    </div>
    <Navigation/>
    <div class="account-display container flex text-white gap-x-3 gap-y-3">
        <section class="w-full md:w-1/2 box-border m-0 p-0">
            <AffiliateCustomerCard :affiliate @openWithdrawModal="togglePaymentShow"/>
            <div class=" bg-black p-[20px] rounded-lg">
                <h2 class="mb-[10px]">Account</h2>
                <hr class="border border-white bg-white"/>
                <div class="flex mb-[20px] justify-between items-center">
                    <h5>Profile</h5>
                </div>
                <form v-if="user !== null" class="mx-0 p-0 !mb-[20px] list-unstyled">
                    <li class="mb-[20px]"><label class="text-sm text-gray-300">Username</label>
                        <TextInput class="block w-full bg-transparent" v-model="form.name"></TextInput>
                    </li>
                    <li class="mb-[20px]"><label class="text-sm text-gray-300">Email Address</label>
                        <TextInput class="block w-full bg-transparent" v-model="form.email"></TextInput>
                    </li>
                    <li class="mb-[20px]"><label class="text-sm text-gray-300">Phone Number</label>
                        <TextInput class="block w-full bg-transparent" v-model="form.phone"></TextInput>
                    </li>
                </form>
                <div class="flex justify-end gap-5">
                    <button class=" text-lg px-[10px] text-red-500 px-[30px] py-[5px] rounded hover:bg-red-500 hover:text-white" @click="form.reset()">Cancel</button>
                    <button class="text-black text-lg bg-green-700 text-white hover:bg-green-700/90  px-[30px] py-[5px] rounded" @click="updateUser">Save</button>
                </div>
            </div>
        </section>
        <div class="w-full md:w-1/2 flex gap-[20px] flex-col h-[fit-content] justify-center items-center py-[50px] bg-black">
            <Link as="button" href="/logout" method="post" class="text-orange-500 text-lg">Log Out</Link>
            <button class="text-orange-500 text-lg">Deactivate Account</button>
            <button class="text-red-500 text-lg">Delete Account</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.account-display {
    @apply flex-wrap md:flex-nowrap;
}

.input-design {
    &:focus {
        @apply border border-white
    }
}


.container {
    & > div {
        @apply rounded-lg;
    }
}

</style>
