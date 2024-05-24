<script setup>

import AdminDashboardMenu from "@/AppComponents/AdminDashboardMenu.vue";
import {Head, useForm} from "@inertiajs/vue3";
import AppPageHeading from "@/AppComponents/AppPageHeading.vue";
import {ref, useAttrs} from "vue";

const attrs = useAttrs()

let userFrom = useForm({
    id: attrs.auth.user.id,
    status: attrs.auth.user.status,
    name: attrs.auth.user.name,
    phone: attrs.auth.user.phone,
    email: attrs.auth.user.email,
})

let securityForm = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
})

async function updateInfo() {
    try {
        const results = await userFrom.patch(route('patchUser', userFrom.id))
    } catch (e){
        console.log(e)
    }
}

async function updatePassword(){
    try{
        const results = await securityForm.patch(route('patchPassword', userFrom.id))
    }catch (e){
        console.log(e)
    }
}

</script>

<template>
    <Head title="Dashboard"/>
    <div class="holder w-full h-[100vh] flex">
        <admin-dashboard-menu/>
        <section class="content-area w-full h-full overflow-auto">
            <app-page-heading :pageHeading="'Account'"/>
            <div class="flex w-full px-[20px] gap-2.5">
                <div class="container w-[65%]">
                    <div class="mb-[30px] rounded-sm  bg-[#565656] p-[10px] text-white">
                        <div class="flex items-center justify-between">
                            <h1 class="text-[25px] mb-[10px]">Profile</h1>
                            <p class="border px-[10px] py-[5px] rounded-2xl text-sm">{{userFrom.status}}</p>
                        </div>
                        <form class="w-[90%] mx-auto font-extralight">
                            <div class="flex flex-col mb-[20px]">
                                <label>Username</label>
                                <input class="rounded h-[35px]" v-model="userFrom.name">
                                <p class="text-red-500">{{ userFrom.errors.name }}</p>
                            </div>
                            <div class="flex gap-2.5  w-full mb-[30px]">
                                <div class="flex flex-col w-full">
                                    <label>Phone</label>
                                    <input class="rounded h-[35px] w-full" v-model="userFrom.phone">
                                    <p class="text-red-500">{{ userFrom.errors.phone }}</p>
                                </div>
                                <div class="flex flex-col w-full">
                                    <label>Email</label>
                                    <input class="rounded h-[35px] w-full" v-model="userFrom.email">
                                    <p class="text-red-500">{{ userFrom.errors.email }}</p>
                                </div>
                            </div>
                            <div class=" mx-auto flex] mb-[30px]">
                                <button class="bg-amber-500 text-white rounded-sm px-[20px] py-[5px]"
                                        @click.prevent.stop="updateInfo">Update
                                </button>
                            </div>

                        </form>
                    </div>
                    <div class="rounded-sm  bg-[#565656] p-[10px] text-white">
                        <h1 class="text-[25px] mb-[10px]">Security</h1>
                        <form class="w-[90%] mx-auto font-extralight">
                            <div class="flex flex-col mb-[20px]">
                                <label>Current Password</label>
                                <input type="password" class="rounded h-[35px]" v-model="securityForm.current_password">
                                <p class="text-red-500">{{ securityForm.errors.current_password }}</p>
                            </div>
                            <div class="flex flex-col mb-[20px]">
                                <label>New Password</label>
                                <input type="password" class="rounded h-[35px]" v-model="securityForm.password">
                                <p class="text-red-500">{{ securityForm.errors.password }}</p>
                            </div>
                            <div class="flex flex-col mb-[20px]">
                                <label>Confirm New Password</label>
                                <input type="password" class="rounded h-[35px]" v-model="securityForm.password_confirmation">
                                <p class="text-red-500">{{ securityForm.errors.password_confirmation }}</p>
                            </div>
                            <div class=" mx-auto flex] mb-[30px]">
                                <button class="bg-amber-500 text-white rounded-sm px-[20px] py-[5px]"
                                        @click.stop.prevent="updatePassword">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container w-[35%] h-[200px] rounded-sm  bg-red-500">
                    <div class="rounded-sm  bg-[#565656] p-[10px] text-white">
                        <h1 class="text-[25px] mb-[10px]">Danger Zone</h1>
                        <form class="w-[90%] mx-auto font-extralight">
                            <div class="flex flex-col mb-[30px]">
                                <label class="text-sm mb-3">Enter your username to confirm Action</label>
                                <input class="rounded h-[35px]">
                            </div>
                            <div class=" mx-auto flex] mb-[30px] flex flex-col gap-2.5">
                                <button class="bg-amber-500 text-white rounded-sm px-[20px]  py-[5px]">Disable Account
                                </button>
                                <button class="bg-red-500 text-white rounded-sm px-[20px] py-[5px]">Delete Acoount
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped lang="scss">

input {
    color: grey;
}

</style>
