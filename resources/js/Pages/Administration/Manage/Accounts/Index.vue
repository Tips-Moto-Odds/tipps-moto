<script setup>
import AdminDashboardMenu from "@/AppComponents/AdminDashboardMenu.vue";
import AppPageHeading from "@/AppComponents/AppPageHeading.vue";

function openSideBar(){
    $('.right-panel')
        .removeClass('closed')
        .addClass('open')
}

function closeSideBar(){
    $('.right-panel')
        .removeClass('open')
        .addClass('closed')
}


</script>


<template>
    <div class="holder w-full h-[100vh] flex relative">
        <admin-dashboard-menu/>
        <section class="content-area w-full h-full overflow-auto">
            <div class="right-panel fixed closed">
                <div class="w-full h-full p-[10px] bg-gray-500 shadow-xl">
                    <div class="flex justify-between">
                        <h1 class="text-2xl text-white">Heading</h1>
                        <div>
                            <button class="bg-red-400 text-white px-[3px] py-[5px] rounded" @click="closeSideBar">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <app-page-heading :pageHeading="'Accounts'"/>
            <div class="container px-[15px]">
                <div class="flex gap-2">
                    <div class="w-8/12 rounded p-[10px] mb-[10px]" style="background-color: #484848">
                        <div class="flex justify-between ">
                            <h6 class="text-white mb-[10px]">All Accounts</h6>
                            <ul class="flex py-2 gap-5 items-center">
                                <li class="flex items-center gap-2 hover:bg-gray-500 px-[10px] rounded py-[12px] cursor-pointer" @click="openSideBar">
                                    <div class="w-[20px] h-[20px] ">
                                        <img width="20" height="25" src="https://img.icons8.com/ios/100/999999/filter--v1.png" alt="filter--v1"/>
                                    </div>
                                    <p class="text-sm" style="color: darkgrey">Filter</p>
                                </li>
                                <li class="flex items-center gap-1 hover:bg-gray-500 px-[10px] rounded py-[1px] cursor-pointer">
                                    <div class="w-[40px] h-[40px] ">
                                        <img width="32" height="32" src="https://img.icons8.com/pastel-glyph/64/999999/download--v1.png" alt="download--v1"/>
                                    </div>
                                    <p class="text-sm" style="color: darkgrey">Export</p>
                                </li>
                            </ul>
                        </div>
                        <table class="text-white w-full">
                            <thead class="h-[50px]">
                            <tr class="text-left border-b-[2px] text-xs">
                                <th>ID</th>
                                <th>User</th>
                                <th>Last Log in</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in $attrs.users" class="border-b h-[70px] text-xs">
                                <td>{{user.id}}</td>
                                <td>
                                    <div class="h-full w-full">
                                        <p class="mb-[5px]">{{user.name}}</p>
                                        <p class="text-xs text-gray-300">{{user.email}}</p>
                                    </div>
                                </td>
                                <td>
                                    <div v-if="user?.activity?.time" class="h-full w-full">
                                        <p class="mb-[5px]">{{user?.activity?.time}}</p>
                                        <p class="text-gray-300">{{user?.activity?.date}}</p>
                                    </div>
                                    <p v-else>N/A</p>
                                </td>
                                <td class="">
                                    <div v-if="user?.DateJoined?.time" class="h-full w-full">
                                        <p class="mb-[5px]">{{user?.DateJoined?.time}}</p>
                                        <p class="text-gray-300">{{user?.DateJoined?.date}}</p>
                                    </div>
                                    <p v-else>N/A</p>
                                </td>
                                <td>
                                    <button class="text-sm py-[3px] px-[10px] bg-red-400 rounded hover:bg-red-700">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-4/12">
                        <div class="p-[10px] rounded overflow-hidden" style="background-color: #484848">
                            <h6 class="text-white  mb-[10px]" >Income Summary</h6>
                            <hr  class="border border-gray-500">
                            <ul class="text-white text-sm ">
                                <li class="flex justify-between py-[8px]">
                                    <p>Total Users</p>
                                    <p>{{$attrs.stats.total}}</p>
                                </li>
                                <li class="flex justify-between py-[8px]">
                                    <p>Total Users</p>
                                    <p>-</p>
                                </li>
                                <li class="flex justify-between py-[8px]">
                                    <p>Total Users</p>
                                    <p>-</p>
                                </li>
                            </ul>
                            <hr  class="border border-gray-500">
                            <ul class="text-white text-sm ">
                                <li class="flex justify-between py-[8px]">
                                    <p>One-Time-Purchase</p>
                                    <p>-</p>
                                </li>
                                <li class="flex justify-between py-[8px]">
                                    <p>Multi-Purchase</p>
                                    <p>-</p>
                                </li>
                            </ul>
                            <hr  class="border border-gray-500">
                            <ul class="text-white text-sm ">
                                <li class="flex justify-between py-[8px]">
                                    <p>Recent Log In(1 Week)</p>
                                    <p>-</p>
                                </li>
                                <li class="flex justify-between py-[8px]">
                                    <p>Monthly-Log-in (1 Month)</p>
                                    <p>-</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style lang="scss">
table{
    tbody{
        tr{
            border-bottom: 2px solid gray;
            @apply rounded-sm overflow-hidden text-xs;

            td{
                vertical-align: top;
                @apply pt-[10px];
            }

            &:hover{
                cursor:           pointer;
                background-color: #575454;
            }
        }
    }
}

</style>
