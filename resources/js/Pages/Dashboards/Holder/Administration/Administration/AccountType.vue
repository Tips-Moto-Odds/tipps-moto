<script setup>
import {router, useForm, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import ListUsers from "@/Pages/Administration/Administration/Components/ListUsers.vue";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {openSideBar, closeSideBar} from "@/HelperFunctions/modalControl.js";

const page = usePage()
const props = defineProps({
    accountType: Object,
    users: Array
})

const accountTypesForm = useForm({
    name: "",
    status: "Active"
})

let searchedUsers = ref([])
const userAccounts = ref([])
const searchForm = useForm({
    searchUserText: ''
})


if (route('CreateAccountType').includes(page.url)) {
    userAccounts.value = null
} else {
    accountTypesForm.id = props.accountType.id
    accountTypesForm.name = props.accountType.name
    accountTypesForm.status = props.accountType.status
}


async function saveAccountType() {
    try {
        if (route('CreateAccountType').includes(page.url)) {
            await accountTypesForm.post(route('postAccount'))
            alert("Created Successfully");
        } else {
            await accountTypesForm.patch(route('patchAccount', [accountTypesForm.id]))
            alert("Updated Successfully");
        }
    } catch (err) {
        console.log(err)
    }
}

async function disableAccountType() {
    if (confirm('Are you sure you want to delete this account type?')) {
        try {
            await router.delete(route('deleteAccountType', accountTypesForm.id))
            router.visit(route('ManageAccountTypes'))
        } catch (err) {
            console.log(err)
        }
    }
}

async function searchUser() {
    try {
        const {data} = await axios.post(route('searchUserByUsername'), searchForm)
        searchedUsers.value = data
    } catch (e) {
        if (e.response && e.response.status === 404) {
            searchedUsers.value = []
        } else {
            console.log(e);
        }
    }
}

async function addUser(user) {
    try {
        const role = props.accountType.id
        const {data} = await axios.post(route('assignRole', [role, user]))
        alert(data.message)
        window.location.href = window.location.href
    } catch (e) {
        if (e.response && e.response.status === 403) {
            alert("Unauthorized Action")
        } else {
            console.log(e)
        }
    }

}

</script>


<template>
    <DashboardLayout>
        <template v-slot:side>
            <div class="right-panel fixed closed">
                <div class="w-full h-full p-[10px] bg-gray-500 shadow-xl">
                    <div class="flex justify-between mb-[20px]">
                        <h1 class="text-2xl text-white">Add Account</h1>
                        <div>
                            <button class="bg-red-400 text-white px-[3px] py-[5px] rounded" @click="closeSideBar">
                                Close
                            </button>
                        </div>
                    </div>
                    <ListUsers :searchForm v-on:searchUser="searchUser" :searchedUsers v-on:addUser="addUser"/>
                </div>
            </div>
        </template>
        <section class="content-area w-full h-full overflow-auto">
            <div class="p-[10px] w-[99%] mx-auto rounded flex">
                <div class="flex gap-2.5">
                    <button @click.prevent.stop="openSideBar"
                            class="bg-gray-500 text-white text-sm px-[10px] py-[5px] rounded-sm">Add Account
                    </button>
                </div>
                <div>
                </div>
            </div>
            <div class="flex p-[20px] gap-2.5">
                <div class="form-container w-[300px]">
                    <div class="form-header">
                        <h1>Info</h1>
                    </div>
                    <form @submit.prevent.stop="saveAccountType">
                        <div class="app-form-group">
                            <label>Name</label>
                            <input v-model="accountTypesForm.name" required>
                            <p class="error">{{ accountTypesForm.errors.name }}</p>
                        </div>
                        <div class="app-form-group">
                            <label>Status</label>
                            <select v-model="accountTypesForm.status">
                                <option selected value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="flex gap-2.5 justify-between mt-[30px]">
                            <button v-if="route('CreateAccountType').includes(page.url)" class="form-action-button"
                                    type="submit">Add
                            </button>
                            <button v-else class="form-action-button" type="submit">Update</button>
                            <button class="form-action-button !bg-red-500" @click.stop.prevent="disableAccountType">Delete</button>
                        </div>
                    </form>
                </div>
                <div v-if="userAccounts" class="app-panel w-[calc(100%-300px)]">
                    <div class="app-panel-heading">
                        <h1>Accounts</h1>
                    </div>
                    <table v-if="users.length > 0" class="w-full">
                        <thead>
                        <tr>
                            <th class="w-[50px] text-left">ID</th>
                            <th class="w-[150px] text-left">Username</th>
                            <th class="w-[150px] text-center">Date Created</th>
                            <th class="w-[150px] text-center">Last Login</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.id }}</td>
                            <td>
                                <div class="w-full">
                                    <p>{{ user.name }}</p>
                                    <p>{{ user.email }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="w-full flex items-center justify-center flex-col">
                                    <p>00/00/0000</p>
                                    <p>00/00/0000</p>
                                </div>
                            </td>
                            <td>
                                <div class="w-full flex items-center justify-center flex-col">
                                    <p>00/00/0000</p>
                                    <p>00/00/0000</p>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p v-else class="text-[30px] text-center text-white">No Records Found</p>
                </div>
            </div>
        </section>
    </DashboardLayout>
</template>


<style scoped lang="scss">
</style>
