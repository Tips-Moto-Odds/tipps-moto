<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {watch} from "vue";
import {debounce} from "lodash";
import FilterPannel from "@/Pages/Administrator/Tips/FilterPannel.vue";
import {useDateFormat} from "@vueuse/shared";

const props = defineProps(['tips', 'search'])
const pageController = useForm({
    search: props.search
});

// Debounced function to fetch users
const fetchTips = debounce((value) => {
    pageController.get(route('dashboard.tips.listTips'), {
        preserveScroll: true
    })
}, 1000);

watch(() => pageController.search, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        fetchTips(newValue);
    }
});


</script>

<template>
    <DashboardLayout page-heading="Matches" title="Matches">
        <div class="hidden md:flex gap-3 px-[10px] mb-4">
            <div class="app-panel flex justify-between w-full">
                <div class="flex justify-between items-center">
                    <Link :href="route('dashboard.matches.createMatch')" as="button" class="action-button bg-gray-500 text-white">Add Match</Link>
                </div>
                <div>
                    <div>
                        <input
                            id="search"
                            v-model="pageController.search"
                            class="rounded-lg"
                            placeholder="Search"
                            type="search"
                        />
                    </div>
                </div>
            </div>
        </div>
        <template v-slot:side>
            <FilterPannel/>
        </template>
        <div class="flex gap-3 px-[10px]">
            <div v-if="tips && tips.data.length > 0" class="app-panel w-full">
                <div class="app-panel-heading flex justify-between items-center">
                    <h4>All Tips</h4>
                    <!--                    <FilterSection/>-->
                </div>
                <table>
                    <thead>
                    <tr class="text-left table-sm">
                        <th class="w-[100px] px-[20px]">ID</th>
                        <th class="w-[200px]">League</th>
                        <th class="">Teams</th>
                        <th class="w-[200px] text-center">Match Times</th>
                        <th class="">Tips Type</th>
                        <th class="">Prediction</th>
                        <th class="">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <Link class="cursor-pointer" v-for="tip in tips.data" :href="route('dashboard.matches.viewMatch',[tip.matches.id])" as="tr">
                        <td class="px-[20px]">{{ tip.id }}</td>
                        <td>{{ tip.matches.league }}</td>
                        <td>
                            <p class="mb-[5px]">Home : {{ tip.matches.home_teams }}</p>
                            <p class="mb-[5px]">Away : {{ tip.matches.away_teams }}</p>
                        </td>
                        <td>
                            <p class="mb-[5px] text-center">{{ useDateFormat(tip.matches.match_start_time, 'MMM DD YYYY') }}</p>
                            <p class="mb-[5px] text-center text-gray-400">{{ useDateFormat(tip.matches.match_start_time, 'hh:mm a') }}</p>
                        </td>
                        <td>{{ tip.prediction_type }}</td>
                        <td>
                            <p v-if="tip.predictions == 1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/X</p>
                            <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">X/2</p>
                            <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/2</p>

                            <p v-else-if="tip.predictions == 1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Home</p>
                            <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Draw</p>
                            <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Away</p>

                            <p v-else-if="tip.predictions == 1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">GG</p>
                            <p v-else-if="tip.predictions == -1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">NG</p>

                            <p v-else class="prediction-card-display">{{ tip.predictions }}</p>
                        </td>
                        <td>{{ tip.status }}</td>
                    </Link>
                    </tbody>
                </table>
                <div>
                    <Pagination :pagination="tips.links"/>
                </div>
            </div>
            <div v-else class="app-panel w-full">
                <div class="flex justify-center items-center h-[300px]">
                    <p class="text-[30px] text-white">No results were found</p>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

