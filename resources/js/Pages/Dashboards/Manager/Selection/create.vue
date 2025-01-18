<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {reactive, ref} from "vue";
import {useDateFormat} from "@vueuse/shared";
import {debounce} from "lodash";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps(['packages'])
const tips = ref([])
const tipsSearchData = ref([])
const tipSearch = ref('')
const selectionPackage = ref(1)
const date_for = ref('')
const active = ref(1)

const debouncedSearchMatch = debounce(() => {
    searchMatch();
}, 300);

function searchMatch() {
    axios.post(route('dashboard.tips.searchTip'), {
        searchTerm: tipSearch.value
    }).then((response) => {
        tipsSearchData.value = response.data;
    })
}

function displaySearch() {
    let element = $('#displaySearch')
    element.removeClass('hidden')
}

function resetSearch() {
    setTimeout(() => {
        tipSearch.value = [];
        let element = $('#displaySearch');
        element.addClass('hidden');
    }, 500);
}

function selectTip(tip) {
    tips.value.push(tip)
}

function createSelection(){
    let form = useForm({
        'packages':selectionPackage.value,
        'date_for':date_for.value,
        'active':active.value,
        'tips':tips.value,
    })

    form.post(route('dashboard.selection.storeSelection'))
}
</script>


<template>
    <DashboardLayout page-heading="Create Selection" title="Create Selection">
        <div class="w-[98%] flex mb-[20px] text-white items-center mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link as="button" :href="route('dashboard.selection.listSelections')" class="action-button bg-gray-500 hover:bg-orange-500">View All Selections</Link>
            </div>
            <div class="flex gap-x-2">
                <button class="action-button bg-blue-600 hover:bg-blue-600/50 " @click="createSelection">Save</button>
            </div>
        </div>
        <div class="md:flex w-100 mx-auto gap-3 text-white px-[5px]">
            <div class="w-100">
                <div class="app-panel">
                    <div class="app-panel-heading mb-[20px] flex justify-between"><h5>Selection Details</h5></div>
                    <div class="w-100 h-[100px] flex flex-col">
                        <label>Package</label>
                        <select v-model="selectionPackage" class="w-[300px] rounded text-black">
                            <option v-for="item in props.packages" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="w-100 h-[100px] flex flex-col">
                        <label>Date For</label>
                        <input v-model="date_for" type="date" class="w-[300px] rounded text-black">
                    </div>
                    <div class="w-100 h-[100px] flex flex-col">
                        <label>Active</label>
                        <select v-model="active" class="w-[300px] rounded text-black">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="app-panel">
                    <div class="app-panel-heading mb-[20px] flex justify-between"><h5>Tips Details</h5></div>
                    <div class="w-100 relative h-[40px]">
                        <input v-model="tipSearch" class="rounded w-100 block text-black" @keyup="debouncedSearchMatch" @blur="resetSearch" @focus="displaySearch">
                        <div id="displaySearch" class="hidden w-100 bg-white rounded shadow" style="z-index: 200">
                            <div class="p-[10px]">
                                <p v-if="tipsSearchData.length == 0" class="p-[20px] text-centers bg-gray-700">No Tips Found</p>
                                <table v-else>
                                    <thead>
                                    <tr class="text-left">
                                        <th class="w-[100px] px-[20px]">ID</th>
                                        <th class="w-[200px]">League</th>
                                        <th class="">Teams</th>
                                        <th class="w-[200px] text-center">Match Times</th>
                                        <th class="">Tips Type</th>
                                        <th class="">Prediction</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="searchedTip in tipsSearchData" @click="selectTip(searchedTip)">
                                        <td class="px-[20px]">{{ searchedTip.id }}</td>
                                        <td>{{ searchedTip.league }}</td>
                                        <td>
                                            <p class="mb-[10px] ">Home : {{ searchedTip.home_teams }}</p>
                                            <p class="mb-[10px] ">Away : {{ searchedTip.away_teams }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-[10px] text-center">{{ useDateFormat(searchedTip.match_start_time, 'MMM DD YYYY') }}</p>
                                            <p class="mb-[10px] text-center">{{ useDateFormat(searchedTip.match_start_time, 'hh:mm a') }}</p>
                                        </td>
                                        <td>{{ searchedTip.prediction_type }}</td>
                                        <td>{{ searchedTip.predictions }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <p v-if="tips.length == 0" class="p-[20px] text-centers bg-gray-700">No Tips Selected</p>
                        <table v-else>
                            <thead>
                            <tr class="text-left">
                                <th class="w-[100px] px-[20px]">ID</th>
                                <th class="w-[200px]">League</th>
                                <th class="">Teams</th>
                                <th class="w-[200px] text-center">Match Times</th>
                                <th class="">Tips Type</th>
                                <th class="">Prediction</th>
                                <th class="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tip in tips">
                                <td class="px-[20px]">{{ tip.id }}</td>
                                <td>{{ tip.league }}</td>
                                <td>
                                    <p class="mb-[10px] ">Home : {{ tip.home_teams }}</p>
                                    <p class="mb-[10px] ">Away : {{ tip.away_teams }}</p>
                                </td>
                                <td>
                                    <p class="mb-[10px] text-center">{{ useDateFormat(tip.match_start_time, 'MMM DD YYYY') }}</p>
                                    <p class="mb-[10px] text-center">{{ useDateFormat(tip.match_start_time, 'hh:mm a') }}</p>
                                </td>
                                <td>{{ tip.prediction_type }}</td>
                                <td>{{ tip.predictions }}</td>
                                <td>
                                    <button>Remove</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss" scoped>
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
