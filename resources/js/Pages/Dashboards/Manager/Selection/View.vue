<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import { ref, computed } from "vue";
import { useDateFormat } from "@vueuse/core"; // Ensure correct package import
import { debounce } from "lodash";
import { getPredictions } from "./Actions.js"; // Ensure correct path

const props = defineProps(["selection", "packages", "tips"]);

// Reactive states
const selectionPackage = ref(props.selection.package_id);
const date_for = ref(props.selection.date_for);
const active = ref(props.selection.status);

// Ensure tips is reactive
const tips = ref(props.tips ? JSON.parse(JSON.stringify(props.tips)) : []);

const tipsSearchData = ref([]);
const tipSearch = ref("");

// Debounce search function
const debouncedSearchMatch = debounce(() => {
    searchMatch();
}, 300);

// Fetch matches based on search term
function searchMatch() {
    axios
        .post(route("dashboard.tips.searchTip"), {
            searchTerm: tipSearch.value,
        })
        .then((response) => {
            tipsSearchData.value = response.data;
        })
        .catch((error) => {
            console.error("Search error:", error);
        });
}

// Display search results
function displaySearch() {
    document.getElementById("displaySearch")?.classList.remove("hidden");
}

// Hide search results after selection
function resetSearch() {
    setTimeout(() => {
        tipSearch.value = "";
        document.getElementById("displaySearch")?.classList.add("hidden");
    }, 500);
}

// Add a tip to the selection
function selectTip(tip) {
    if (!tip) return;

    const tipValue = {
        tip_id: tip.id,
        match_id: tip.id, // Ensure match_id is properly assigned
        league: tip.league,
        home_teams: tip.home_teams,
        away_teams: tip.away_teams,
        match_start_time: tip.match_start_time,
        prediction_type: tip.prediction_type,
        predictions: tip.predictions,
        mark_as_free: 0, // Default value
    };

    // Avoid duplicate tips
    const exists = tips.value.some((t) => t.tip_id === tipValue.tip_id);
    if (!exists) {
        tips.value.push(tipValue);
    }
}

// Update selection
function updateSelection() {
    useForm({
        packages: selectionPackage.value,
        date_for: date_for.value,
        active: active.value,
        tips: tips.value,
    }).patch(route("dashboard.selection.updateSelection", [props.selection.id]));
}

// Remove tip from selection
function removeTip(tip_id) {
    tips.value = tips.value.filter((tip) => tip.tip_id !== tip_id);
}

// Delete selection
function deleteSelection() {
    useForm({
        packages: selectionPackage.value,
        date_for: date_for.value,
        active: active.value,
        tips: tips.value,
    }).delete(route("dashboard.selection.deleteSelection", [props.selection.id]));
}

</script>

<template>
    <DashboardLayout :page-heading="'View Selection : '" title="View Selection">
        <div class="w-[98%] flex mb-[20px] text-white items-center mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link
                    as="button"
                    :href="route('dashboard.selection.listSelections')"
                    class="action-button bg-gray-500 hover:bg-orange-500"
                >
                    View All Selections
                </Link>
            </div>
            <div class="flex gap-x-2">
                <button class="action-button bg-orange-600 hover:bg-blue-600/50" @click="updateSelection">
                    Update
                </button>
                <button class="action-button bg-red-600 hover:bg-blue-600/50" @click="deleteSelection">
                    Delete
                </button>
            </div>
        </div>

        <div class="md:flex w-100 mx-auto gap-3 text-white px-[5px]">
            <div class="w-100">
                <div class="app-panel">
                    <div class="app-panel-heading mb-[20px] flex justify-between">
                        <h5>Selection Details</h5>
                    </div>
                    <div class="w-100 h-[100px] flex flex-col">
                        <label>Package</label>
                        <select v-model="selectionPackage" class="w-[300px] rounded text-black">
                            <option v-for="item in props.packages" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                    <div class="w-100 h-[100px] flex flex-col">
                        <label>Date For</label>
                        <input v-model="date_for" type="date" class="w-[300px] rounded text-black" />
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
                    <div class="app-panel-heading mb-[20px] flex justify-between">
                        <h5>Tips Details</h5>
                    </div>
                    <div class="w-100 relative h-[40px]">
                        <input
                            v-model="tipSearch"
                            class="rounded w-100 block text-black"
                            @keyup="debouncedSearchMatch"
                            @blur="resetSearch"
                            @focus="displaySearch"
                        />
                        <div id="displaySearch" class="hidden w-100 bg-white rounded shadow" style="z-index: 200">
                            <div class="p-[10px]">
                                <p v-if="tipsSearchData.length == 0" class="p-[20px] text-center bg-gray-700">
                                    No Tips Found
                                </p>
                                <table v-else>
                                    <thead>
                                    <tr class="text-left">
                                        <th>ID</th>
                                        <th>League</th>
                                        <th>Teams</th>
                                        <th>Match Time</th>
                                        <th>Tips Type</th>
                                        <th>Prediction</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="searchedTip in tipsSearchData" @click="selectTip(searchedTip)">
                                        <td>{{ searchedTip.id }}</td>
                                        <td>{{ searchedTip.league }}</td>
                                        <td>
                                            <p>Home: {{ searchedTip.home_teams }}</p>
                                            <p>Away: {{ searchedTip.away_teams }}</p>
                                        </td>
                                        <td>{{ useDateFormat(searchedTip.match_start_time, 'YYYY-MM-DD HH:mm') }}</td>
                                        <td>{{ searchedTip.prediction_type }}</td>
                                        <td>{{ getPredictions(searchedTip.prediction_type, searchedTip.predictions) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div v-if="tips.length > 0">
                        <table>
                            <thead>
                            <tr>
                                <th>League</th>
                                <th>Teams</th>
                                <th>Match Time</th>
                                <th>Tips Type</th>
                                <th>Prediction</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tip in tips">
                                <td>{{ tip.league }}</td>
                                <td>{{ tip.home_teams }} vs {{ tip.away_teams }}</td>
                                <td>{{ useDateFormat(tip.match_start_time, 'YYYY-MM-DD HH:mm') }}</td>
                                <td>{{ tip.prediction_type }}</td>
                                <td>{{ getPredictions(tip.prediction_type, tip.predictions) }}</td>
                                <td>
                                    <button class="bg-red-500 text-white px-2 py-1" @click="removeTip(tip.tip_id)">
                                        Remove
                                    </button>
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
