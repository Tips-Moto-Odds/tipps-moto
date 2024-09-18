<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {closeSideBar} from "@/HelperFunctions/modalControl.js";
import FilterSection from "@/AppComponents/FilterSection.vue";
</script>

<template>
    <DashboardLayout :title="'Accounts'" :page-heading="'Accounts'">
        <template v-slot:side>
            <div class="right-panel fixed closed">
                <div class="w-full h-full p-[10px] bg-gray-500 shadow-xl">
                    <div class="flex justify-between">
                        <h1 class="text-2xl text-white">Filter Accounts</h1>
                        <div>
                            <button class="bg-red-400 text-white px-[3px] py-[5px] rounded" @click="closeSideBar">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="flex gap-3 px-[15px]">
            <div class="app-panel w-8/12">
                <div class="app-panel-heading flex justify-between items-center">
                    <h1>All Accounts</h1>
                    <FilterSection/>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Last Log in</th>
                        <th>Date Created</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in $attrs.users" class="h-[70px]">
                        <td>{{ user.id }}</td>
                        <td>
                            <div class="h-full w-full">
                                <p class="mb-[5px]">{{ user.name }}</p>
                                <p class="mild">{{ user.email }}</p>
                            </div>
                        </td>
                        <td>
                            <div v-if="user?.activity?.time" class="h-full w-full">
                                <p class="mb-[5px]">{{ user?.activity?.time }}</p>
                                <p class="mild">{{ user?.activity?.date }}</p>
                            </div>
                            <p v-else>N/A</p>
                        </td>
                        <td class="">
                            <div v-if="user?.DateJoined?.time" class="h-full w-full">
                                <p class="mb-[5px]">{{ user?.DateJoined?.time }}</p>
                                <p class="mild">{{ user?.DateJoined?.date }}</p>
                            </div>
                            <p v-else>N/A</p>
                        </td>
                        <td class="text-right">
                            <button class="app-delete">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="app-panel w-4/12">
                <div class="app-panel-heading">
                    <h1>User Summary</h1>
                </div>
                <div class="list-display">
                    <ul>
                        <li><p>Total Users</p>
                            <p>{{ $attrs.stats.total }}</p></li>
                        <li><p>Total Users</p>
                            <p>-</p></li>
                        <li><p>Total Users</p>
                            <p>-</p></li>
                    </ul>
                    <hr>
                    <ul>
                        <li><p>One-Time-Purchase</p>
                            <p>-</p></li>
                        <li><p>Multi-Purchase</p>
                            <p>-</p></li>
                    </ul>
                    <hr>
                    <ul>
                        <li><p>Recent Log In(1 Week)</p>
                            <p>-</p></li>
                        <li><p>Monthly-Log-in (1 Month)</p>
                            <p>-</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss">

</style>
