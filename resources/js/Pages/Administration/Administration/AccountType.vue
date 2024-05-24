<script setup>
import AdminDashboardMenu from "@/AppComponents/AdminDashboardMenu.vue";
import AppPageHeading from "@/AppComponents/AppPageHeading.vue";
import {Head, router, useForm, usePage} from "@inertiajs/vue3";
import {reactive, ref, useAttrs} from "vue";
import ListUsers from "@/Pages/Administration/Administration/ListUsers.vue";

const page = usePage()
const props = defineProps({
    accountType: {
        type: Object,
    },
    users: {
        type: Array,
    }
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
            let response = await router.delete(route('deleteAccountType', accountTypesForm.id))
            router.visit(route('ListAccountTypes'))
        } catch (err) {
            console.log(err)
        }

    }
}

function openSideBar() {
    $('.right-panel')
        .removeClass('closed')
        .addClass('open')
}

function closeSideBar() {
    $('.right-panel')
        .removeClass('open')
        .addClass('closed')
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
    <Head title="Dashboard"/>
    <div class="holder w-full h-[100vh] flex">
        <admin-dashboard-menu/>
        <section class="content-area w-full h-full overflow-auto">

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


            <app-page-heading :pageHeading="'Account Types'"/>

            <div class="p-[10px] w-[99%] mx-auto rounded flex">
                <ul class="flex gap-2.5">
                    <button @click.prevent.stop="openSideBar"
                            class="bg-gray-500 text-white text-sm px-[10px] py-[5px] rounded-sm">Add Account
                    </button>
                </ul>
                <div>
                </div>
            </div>


            <div class="flex p-[20px] gap-2.5">
                <div class="w-[300px] bg-gray-500 h-[400px] rounded">
                    <h1 class="text-white p-[20px]">Info</h1>
                    <form class="px-[30px] text-white text-sm" @submit.prevent.stop="saveAccountType">
                        <div class="mb-[10px]">
                            <label class="block mb-[5px]">Name</label>
                            <input class="rounded w-full mb-[10px] h-[35px] text-gray-500"
                                   v-model="accountTypesForm.name"
                                   required>
                            <p class="text-red-300 text-sm">{{ accountTypesForm.errors.name }}</p>
                        </div>
                        <div>
                            <label class="block mb-[5px]">Status</label>
                            <select class="w-full rounded p-1.5 h-[35px] text-gray-500"
                                    v-model="accountTypesForm.status">
                                <option selected value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="flex justify-between py-[20px]">
                            <button v-if="route('CreateAccountType').includes(page.url)" class="bg-amber-500"
                                    type="submit">Add
                            </button>
                            <button v-else class="bg-amber-500" type="submit">Update</button>
                            <button class="bg-red-400" @click.stop.prevent="disableAccountType">Delete</button>
                        </div>
                    </form>
                </div>
                <div v-if="userAccounts" class=" w-[calc(100%-300px)] bg-gray-500 h-[400px] rounded px-[10px]">
                    <h1 class="p-[20px] text-white px-[10px]">Accounts</h1>
                    <table v-if="users.length > 0" class="w-full">
                        <thead class="text-white border-b-gray-400 border-b">
                        <tr class="text-sm">
                            <th class="w-[50px] text-left">ID</th>
                            <th class="w-[150px] text-left">Username</th>
                            <th class="w-[150px] ">Date Created</th>
                            <th class="w-[150px] ">Last Login</th>
                        </tr>
                        </thead>
                        <tbody class="text-white">
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
    </div>
</template>


<style scoped lang="scss">
table {
    tbody {
        tr {
            border-bottom: 2px solid gray;
            @apply rounded-sm overflow-hidden text-xs;

            td {
                vertical-align: top;
                @apply pt-[10px];
            }

            &:hover {
                cursor: pointer;
                background-color: #575454;
            }
        }
    }
}

form {
    button {
        @apply px-[15px] rounded-sm py-[5px];
    }
}

</style>
