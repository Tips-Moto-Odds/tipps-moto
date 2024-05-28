<script setup>
import AdminDashboardMenu from "@/Layouts/AdministrationLayout/AdminDashboard/AdminDashboardMenu.vue";
import AppPageHeading from "@/Layouts/AdministrationLayout/DashboardHeading/AppPageHeading.vue";
import {Link} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";

const props = defineProps(['tip'])

</script>


<template>
    <DashboardLayout title="View Tip" page-heading="View Tip">
        <div class="w-[98%] flex mb-[20px] text-white mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link :href="route('listTips')" class="action-button bg-gray-500">View All tips</Link>
            </div>
            <div>
                <button class="action-button bg-red-600">Delete Tip</button>
            </div>
        </div>
        <div class="flex w-[98%] mx-auto gap-3 text-white">
            <div class="w-8/12">
                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h1>Current Match</h1>
                    </div>
                    <div class="w-[60%] pb-[20px] mx-auto pt-[20px] text-center text-[20px] items-center rounded mb-[40px]">
                        <h2 class="mb-[20px]">Match ID: </h2>
                        <div class="flex justify-between items-center gap-5 mb-[10px]">
                            <div class="w-[150px] h-[150px] bg-white"></div>
                            <div><p>VS</p></div>
                            <div class="w-[150px] h-[150px] bg-white"></div>
                        </div>
                        <div class="text-sm mb-[10px]">
                            <p>May 1st 2024</p>
                            <p>12:00</p>
                        </div>
                        <div>
                            <p class="px-[10px] py-[5px] bg-green-500 rounded-sm">Home Win</p>
                        </div>
                    </div>
                </div>

                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h1 class="text-[25px] text-white mb-[20px]">Upcoming Matches</h1>
                    </div>
                    <div class="flex flex-wrap justify-around">
                        <div v-for="item in 10" class="w-[250px] h-[150px] shadow mb-[10px] pt-[10px] bg-gray-500 rounded">
                            <div class="w-full h-[80px] flex justify-center gap-2.5 items-center mb-[5px]">
                                <div class="h-[80px] w-[80px] bg-white rounded"></div>
                                <div>
                                    <p class="text-sm">vs</p>
                                </div>
                                <div class="h-[80px] w-[80px] bg-white rounded"></div>
                            </div>
                            <p class="text-sm text-center">Sat, May</p>
                            <p class="text-sm text-center">14:00</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class=" w-4/12">

                <div class="app-panel side-section">
                    <h1>Info</h1>
                    <ul>
                        <li>
                            <p>Home</p>
                            <p>Chelsea</p>
                        </li>
                        <li class="!mb-[20px]">
                            <p>Away</p>
                            <p>Man City</p>
                        </li>
                        <li>
                            <p>Home :</p>
                            <ul>
                                <li class="win">W</li>
                                <li class="lost">L</li>
                                <li class="draw">D</li>
                                <li class="lost">L</li>
                                <li class="win">W</li>
                            </ul>
                        </li>
                        <li>
                            <p>Away :</p>
                            <ul>
                                <li class="win">W</li>
                                <li class="win">W</li>
                                <li class="lost">L</li>
                                <li class="draw">D</li>
                                <li class="lost">L</li>
                            </ul>
                        </li>
                    </ul>

                </div>

                <div class="app-panel side-section">
                    <h1>Status</h1>
                    <ul>
                        <li>
                            <p>Status</p>
                            <p>Pending</p>
                        </li>
                        <li>
                            <p>Results</p>
                            <p>Pending</p>
                        </li>
                        <li>
                            <p>Accuracy</p>
                            <p>pending</p>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss" scoped>
.action-button {
    @apply px-[10px] py-[8px] rounded-sm;
}

.side-section {
    @apply p-2 rounded;

    & > h1 {
        @apply text-[25px] font-light mb-[20px]
    }

    & > ul {
        @apply px-[10px];
        & > li {
            @apply flex justify-between mb-[10px];

            ul {
                @apply flex items-center gap-5;

                li {
                    @apply text-sm w-[20px] h-[20px] text-center rounded-[50%];
                }

                li.win {
                    @apply bg-green-500;
                }

                li.draw {
                    @apply bg-orange-500;
                }

                li.lost {
                    @apply bg-red-500;
                }
            }
        }
    }
}

</style>
