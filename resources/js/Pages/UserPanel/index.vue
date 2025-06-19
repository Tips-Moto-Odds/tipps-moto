<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import {router, useForm, usePage} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
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
            router.reload()
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

const makeDeposit = () => {

}
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <Navigation/>
    <div class="account-display container flex text-white gap-x-3 gap-y-3">
        <section class="w-full md:w-1/2 box-border m-0 p-0">
            <div v-if="user.latest_balance" class=" bg-black p-[20px] rounded-lg mb-4">
              <h2 class="mb-[10px] text-center">Account Balance</h2>
                <div class="bg-[#433F3F] rounded p-[20px] text-center"
                     style="box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);">
                  <h2 class="mb-3">KES {{ user.latest_balance.balance_after }}</h2>
                  <!--                    <div>-->
                  <!--                        <button @click.prevent="makeDeposit" class="app-button px-4 py-2 rounded">Add Balance</button>-->
                  <!--                    </div>-->
                </div>
            </div>
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
                  <button
                      class=" text-lg px-[10px] text-red-500 px-[30px] py-[5px] rounded hover:bg-red-500 hover:text-white"
                      @click="form.reset()">Cancel
                  </button>
                  <button
                      class="text-black text-lg bg-green-700 text-white hover:bg-green-700/90  px-[30px] py-[5px] rounded"
                      @click="updateUser">Save
                  </button>
                </div>
            </div>
        </section>
      <div
          class="w-full md:w-1/2 flex gap-[20px] flex-col h-[fit-content] justify-center items-center py-[50px] bg-black">
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
