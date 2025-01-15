<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import {usePage} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";

const page = usePage()
const user = page?.props?.user
</script>

<template>
    <Head>
        <title>Dashboard</title>
    </Head>
    <Navigation/>
    <div class="container flex flex-col md:flex-row text-white flex gap-2">
        <div class=" w-full  md:w-[70%] bg-black p-[20px]">
            <h2 class="mb-[10px]">Account</h2>
            <hr class="border border-white bg-white"/>
            <div class="flex mb-[20px] justify-between items-center">
                <h5>Profile</h5>
            </div>
            <form v-if="user !== null" class="mx-0 p-0 !mb-[20px] list-unstyled">
                <li class="mb-[20px]"><label class="text-sm text-gray-300">Username</label>
                    <TextInput class="block w-full bg-transparent" v-model="user.name"></TextInput>
                </li>
                <li class="mb-[20px]"><label class="text-sm text-gray-300">Email Address</label>
                    <TextInput class="block w-full bg-transparent" v-model="user.email"></TextInput>
                </li>
                <li class="mb-[20px]"><label class="text-sm text-gray-300">Phone Number</label>
                    <TextInput class="block w-full bg-transparent" v-model="user.phone"></TextInput>
                </li>
            </form>
            <div class="flex justify-end gap-5">
                <button class=" text-lg px-[10px] text-red-500 px-[30px] py-[5px] rounded hover:bg-red-500 hover:text-white">Cancel</button>
                <button class="text-black text-lg bg-green-700 text-white hover:bg-green-700/90  px-[30px] py-[5px] rounded">Save</button>
            </div>
        </div>
        <div class="w-full md:w-[30%] flex gap-[20px] flex-col justify-center items-center py-[50px] bg-black">
            <Link as="button" href="/logout" method="post" class="text-orange-500 text-lg">Log Out</Link>
            <button class="text-orange-500 text-lg">Deactivate Account</button>
            <button class="text-red-500 text-lg">Delete Account</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.input-design {
    &:focus {
        @apply border border-white
    }
}


.container {
    div {
        @apply rounded-lg;
    }
}

</style>
