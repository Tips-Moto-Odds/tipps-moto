<script setup>
import AdminDashboardMenu from "@/Layouts/AdministrationLayout/AdminDashboard/AdminDashboardMenu.vue";
import AppPageHeading from "@/Layouts/AdministrationLayout/DashboardHeading/AppPageHeading.vue";
import {Link, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";

const props = defineProps(['tip'])
const page = usePage()


function formatDate(dateTimeString) {
    const date = new Date(dateTimeString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${month}-${day}-${year}`;
}

function formatTime(dateTimeString) {
    const date = new Date(dateTimeString);
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}
const accountType = page.props.account_type


</script>


<template>
    <DashboardLayout title="View Tip" page-heading="View Tip">
        <div class="w-[98%] flex mb-[20px] text-white mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link :href="route('ManageTips')" class="action-button bg-gray-500">View All tips</Link>
            </div>
            <div v-if="accountType === 'Administrator' || accountType === 'Manager'" >
                <button class="action-button bg-red-600">Delete Tip</button>
            </div>
        </div>
        <div class="md:flex w-[98%] mx-auto gap-3 text-white px-[5px]">
            <div class="md:w-8/12">
                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h1>Current Match</h1>
                    </div>
                    <div class="md:w-[60%] pb-[20px] mx-auto pt-[20px] text-center text-[20px] items-center rounded mb-[40px]">
                        <h2 class="mb-[20px]">Match ID: </h2>
                        <div class="flex justify-between items-center gap-5 mb-[10px]">
                            <div class="w-[150px] h-[150px] bg-white flex items-center justify-center rounded p-2">
                                <img class="max-w-full max-h-full object-contain object-center" :src="'/storage/System/TeamLogos/'+tip.home_team_image">
                            </div>
                            <div><p>VS</p></div>
                            <div class="w-[150px] h-[150px] bg-white flex items-center justify-center rounded p-2">
                                <img class="max-w-full max-h-full object-contain object-center" :src="'/storage/System/TeamLogos/'+tip.away_team_image">
                            </div>
                        </div>
                        <div class="text-sm mb-[10px]">
                            <p>{{formatDate(tip.match_start_time)}}</p>
                            <p>{{ formatTime(tip.match_start_time) }}</p>
                        </div>
                        <div>
                            <p v-if="tip.predictions === 0" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{tip.predictions === 0 ? 'Draw' : '' }}</p>
                            <p v-if="tip.predictions === 1" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{tip.predictions === 1 ? 'Home Win' : ''}}</p>
                            <p v-if="tip.predictions === 2" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{tip.predictions === 2 ? 'Away Win' : ''}}</p>
                        </div>
                    </div>
                </div>

                <div class="hidden app-panel lg:block">
                    <div class="app-panel-heading">
                        <h1 class="text-[25px] text-white mb-[20px]">Upcoming Matches</h1>
                    </div>
<!--                    <div class="flex flex-wrap justify-around">-->
<!--                        <div v-for="item in 10" class="w-[250px] h-[150px] shadow mb-[10px] pt-[10px] bg-gray-500 rounded">-->
<!--                            <div class="w-full h-[80px] flex justify-center gap-2.5 items-center mb-[5px]">-->
<!--                                <div class="h-[80px] w-[80px] bg-white rounded"></div>-->
<!--                                <div>-->
<!--                                    <p class="text-sm">vs</p>-->
<!--                                </div>-->
<!--                                <div class="h-[80px] w-[80px] bg-white rounded"></div>-->
<!--                            </div>-->
<!--                            <p class="text-sm text-center">Sat, May</p>-->
<!--                            <p class="text-sm text-center">14:00</p>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>

            </div>
            <div class="md:w-4/12">

                <div class="app-panel side-section">
                    <h1>Info</h1>
                    <ul>
                        <li>
                            <p>Home</p>
                            <p>{{tip.home_teams}}</p>
                        </li>
                        <li class="!mb-[20px]">
                            <p>Away</p>
                            <p>{{tip.away_teams}}</p>
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
                            <p>{{tip.status}}</p>
                        </li>
                        <li>
                            <p>Accuracy</p>
                            <p>{{parseInt(tip.predictions_accuracy)}}%</p>
                        </li>
                        <li v-if="parseInt(tip.winning_status) === 0 || parseInt(tip.winning_status) === 1">
                            <p>Wining status</p>
                            <p v-if="tip.winning_status === 0" class="bg-red-600 px-[5px] rounded">Lost</p>
                            <p v-else class="bg-green-500 px-[5px] rounded">Won</p>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss" scoped>
.action-button {
    @apply  rounded-sm;
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
