<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import {watch} from "vue";
import {debounce} from "lodash";
import FilterPannel from "@/Pages/Dashboards/Administrator/Tips/FilterPannel.vue";
import {useDateFormat} from "@vueuse/shared";
import hasAccess from "@/HelperFunctions/getAccess.js";

const props = defineProps(['matches', 'search'])
const page = usePage()
const accountType = page.props.account_type
console.log(accountType)
const pageController = useForm({
    search: props.search
});

// Debounced function to fetch users
const fetchMatches = debounce((value) => {
    pageController.get(route('dashboard.matches.listMatches'), {
        preserveScroll: true
    })
}, 1000);

watch(() => pageController.search, (newValue, oldValue) => {
    if (newValue !== oldValue) {
        fetchMatches(newValue);
    }
});


</script>

<template>
    <DashboardLayout page-heading="Matches" title="Matches">
        <div v-if="hasAccess(accountType,'Moderator')" class="flex gap-3 px-[10px] mb-4">
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
            <div v-if="matches && matches.data.length > 0" class="app-panel w-full">
                <div class="app-panel-heading flex justify-between items-center">
                    <h4>All Matches</h4>
                    <FilterSection/>
                </div>
                <table>
                    <thead>
                    <tr class="text-left">
                        <th class="w-[100px] px-[20px]">ID</th>
                        <th class="w-[200px]">League</th>
                        <th class="">Teams</th>
                        <th class="w-[200px] text-center">Match Times</th>
                        <th class="">Tips</th>
                        <th class="">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <Link class="cursor-pointer" v-for="match in matches.data" :href="route('dashboard.matches.viewMatch',[match.id])" as="tr">
                        <td class="px-[20px]">{{ match.id }}</td>
                        <td>{{ match.league }}</td>
                        <td>
                            <p class="mb-[10px] ">Home : {{ match.home_teams }}</p>
                            <p class="mb-[10px] ">Away : {{ match.away_teams }}</p>
                        </td>
                        <td>
                            <p class="mb-[10px] text-center">{{ useDateFormat(match.match_start_time,'MMM DD YYYY').value }}</p>
                            <p class="mb-[10px] text-center">{{ useDateFormat(match.match_start_time,'hh:mm a').value }}</p>
                        </td>
                        <td>
                            {{match.tips.length}}
                        </td >
                        <td>{{ match.status }}</td>
                    </Link>
                    </tbody>
                </table>
                <div>
                    <Pagination :pagination="matches.links"/>
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

