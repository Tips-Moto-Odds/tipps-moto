<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/AppComponents/Pagination.vue";
import {Link} from "@inertiajs/vue3"
import {openSideBar, closeSideBar} from "@/HelperFunctions/modalControl.js";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/FilterSection.vue";

const props = defineProps(['tips'])

</script>

<template>
    <DashboardLayout title="Tips" page-heading="Tips">
        <template v-slot:side>
            <div class="right-panel fixed closed">
                <div class="w-full h-full p-[10px] bg-gray-500 shadow-xl">
                    <div class="flex justify-between">
                        <h1 class="text-2xl text-white">Filter Tips</h1>
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
                    <h1>All Tips</h1>
                    <FilterSection/>
                </div>
                <table class="text-white w-full mb-[20px]">
                    <thead class="h-[50px]">
                    <tr class="text-left border-b-[2px] text-xs">
                        <th class="text-center">ID</th>
                        <th>Teams</th>
                        <th>Odds</th>
                        <th class="text-center">Prediction</th>
                        <th>Status</th>
                        <th>Wining Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <Link as="tr" :href="route('viewTip',[tip.id])" v-for="tip in tips.data"
                          class="border-b h-[70px] text-xs">
                        <td class="w-[50px] text-center">{{ tip.id }}</td>
                        <td>
                            <div class="h-full w-full">
                                <p class="">Home : {{ tip.home_teams }}</p>
                                <p class="">Away : {{ tip.away_teams }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="h-full w-full">
                                <p><span class="w-[80px] mr-[10px]">Home Odd:</span> {{ tip.home_odds }}</p>
                                <p><span class="w-[80px] mr-[10px]">Draw Odd:</span> {{ tip.draw_odds }}</p>
                                <p><span class="w-[80px] mr-[10px]">Away Odd:</span> {{ tip.away_odds }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="w-80px">
                                <p class="w-[80px] text-center">{{ tip.predictions }}</p>
                                <p class="w-[80px] text-center">{{ Math.round(tip.predictions_accuracy) }} %</p>
                            </div>
                        </td>
                        <td>
                            <p>{{ tip.status }}</p>
                        </td>
                        <td class="text-center">
                            <p class="text-green-500" v-if="tip.winning_status == 1">Won</p>
                            <p class="text-red-500" v-else-if="tip.winning_status == 0">Lost</p>
                            <p class="text-orange-400" v-else>N/A</p>
                        </td>
                        <td>
                            <danger-button>Delete</danger-button>
                        </td>
                    </Link>
                    </tbody>
                </table>
                <div>
                    <Pagination :pagination="tips.links"/>
                </div>
            </div>
            <div class="w-4/12">
                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h1>All Time Summary</h1>
                    </div>
                    <div class="list-display">
                        <ul class="">
                            <li><p>Total Tips</p>
                                <p>-</p></li>
                            <li><p>Future</p>
                                <p>-</p></li>
                            <li><p>Current</p>
                                <p>-</p></li>
                            <li><p>Past</p>
                                <p>-</p></li>
                        </ul>
                        <hr>
                        <ul>
                            <li><p>Total Wins</p>
                                <p>-</p></li>
                            <li><p>Total Losses</p>
                                <p>-</p></li>
                            <li><p>Win Percentage</p>
                                <p>-</p></li>
                        </ul>
                    </div>
                </div>
                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h1>Daily Summary</h1>
                    </div>
                    <div class="list-display">
                        <ul>
                            <li><p>Tips Sold</p>
                                <p>-</p></li>
                            <li><p>Winning Accuracy</p>
                                <p>-</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss">
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

</style>
