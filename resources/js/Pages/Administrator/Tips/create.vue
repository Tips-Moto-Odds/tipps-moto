<script setup>
import {Link, useForm, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {onMounted, reactive, ref} from "vue";
import CreateTipForm from "@/Pages/Administrator/Tips/CreateTipForm.vue";

const props = defineProps(['tip'])
const page = usePage()
const accountType = page.props.account_type
const extra_odds = ref([]);
const tipForm = useForm({
    home_teams: props.tip.home_teams,
    away_teams: props.tip.away_teams,
    home_odds: props.tip.home_odds,
    draw_odds: props.tip.draw_odds,
    away_odds: props.tip.away_odds,
    predictions: props.tip.predictions,
    match_start_time: props.tip.match_start_time,
    status: props.tip.status,
    match_confidence: props.tip.match_confidence,
    winning_status: props.tip.winning_status,
    extra_odds: {}
})

const extra_odd = reactive({
    oddType: '',
    oddValue: ''
})

const add_extra_odd = () => {
    if (extra_odd.oddType && extra_odd.oddValue) {
        extra_odds.value[extra_odd.oddType] = extra_odd.oddValue;

        extra_odd.oddType = '';
        extra_odd.oddValue = '';
    }
};

const removeTip = (label) => {
    delete extra_odds.value[label];
};

const updateTip = () => {
    tipForm.put(route('dashboard.tips.update', props.tip.id), {
        onSuccess: () => {
            alert('Tip updated successfully');
        }
    });
};

const deleteTip = () => {
    tipForm.delete(route('dashboard.tips.delete', props.tip.id), {
        onSuccess: () => {
            alert('Tip deleted successfully');
        }
    });
};

onMounted(() => {
    extra_odds.value = JSON.parse(props.tip.extra_odds || '[]');
    tipForm.extra_odds = extra_odds.value;
});

</script>


<template>
    <DashboardLayout page-heading="View Tip" title="View Tip">
        <div class="w-[98%] flex mb-[20px] text-white items-center mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link as="button" :href="route('dashboard.tips.listTips')" class="action-button">View All tips</Link>
            </div>
            <div v-if="accountType === 'Administrator' || accountType === 'Moderator'">
                <button class="action-button bg-orange-500 mx-[10px]" @click.prevent="updateTip">Update</button>
                <button class="action-button bg-red-600" @click.prevent="deleteTip">Delete Tip</button>
            </div>
        </div>
        <div class="md:flex w-[98%]  mx-auto gap-3 text-white px-[5px]">
            <div class="md:w-8/12">
                <div class="app-panel">
                    <div class="app-panel-heading flex justify-between">
                        <h5>Tip Details</h5>
                    </div>
                    <CreateTipForm :tipForm="tipForm"/>
                </div>
                <div class="app-panel">
                    <div class="app-panel-heading flex justify-between">
                        <h5>Tip</h5>
                    </div>
                    <div class="pb-[20px] mx-auto pt-[20px] text-center text-[20px] items-center rounded mb-[40px]">
                        <div class="mb-[10px]">
                            <label>League</label>
                            <input v-model="tipForm.predictions" class="w-full rounded self-end text-black">
                        </div>
                        <div class="flex mb-[20px] flex-wrap w-full justify-between">
                            <div class="w-1/2 flex flex-col mb-[50px]">
                                <label>Home Team</label>
                                <input v-model="tipForm.home_teams" class="w-[95%] rounded text-black">
                            </div>
                            <div class="w-1/2 flex flex-col mb-[50px]">
                                <label>Away Team</label>
                                <input v-model="tipForm.away_teams" class="w-[95%] rounded self-end text-black">
                            </div>
                            <div class="w-1/3 flex flex-col mb-[10px]">
                                <label>Home Odds</label>
                                <input v-model="tipForm.home_odds" class="w-[95%] rounded text-black">
                            </div>
                            <div class="w-1/3 flex flex-col mb-[10px]">
                                <label>Draw Odds</label>
                                <input v-model="tipForm.draw_odds" class="w-[95%] rounded text-black">
                            </div>
                            <div class="w-1/3 flex flex-col mb-[10px]">
                                <label>Away Odds</label>
                                <input v-model="tipForm.away_odds" class="w-[95%] rounded self-end text-black">
                            </div>
                        </div>
                        <div class="mb-[10px]">
                            <label>Prediction</label>
                            <input v-model="tipForm.predictions" class="w-full rounded self-end text-black">
                        </div>
                        <div>
                            <p v-if="tip.predictions === 0" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{ tip.predictions === 0 ? 'Draw' : '' }}</p>
                            <p v-if="tip.predictions === 1" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{ tip.predictions === 1 ? 'Home Win' : '' }}</p>
                            <p v-if="tip.predictions === 2" class="px-[10px] py-[5px] bg-green-500 rounded-sm">{{ tip.predictions === 2 ? 'Away Win' : '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="hidden app-panel lg:block">
                    <div class="app-panel-heading">
                        <h1 class="text-[25px] text-white mb-[30px]">Other Tips</h1>
                        <div class="mb-[20px] flex justify-between">
                            <div class="flex gap-3">
                                <div class="flex items-center gap-1.5">
                                    <label>Odd Type:</label>
                                    <input v-model="extra_odd.oddType" class="rounded h-[30px] text-gray-800">
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <label>Odd Type:</label>
                                    <input v-model="extra_odd.oddValue" class="rounded h-[30px] text-gray-800">
                                </div>
                            </div>
                            <div class="mx-[20px]">
                                <button class="bg-orange-400 px-[10px] py-[3px] rounded" @click.prevent="add_extra_odd">Add</button>
                            </div>
                        </div>
                        <ul class="flex">
                            <li v-for="(value, label) in extra_odds" :key="label" class="bg-gray-700 px-[10px] py-[5px] m-[5px] hover:bg-gray-600 relative">
                                <p>{{ label }}: {{ value }} <span @click.prevent="removeTip(label)"><i class="bi bi-x-circle-fill mx-[5px]"></i></span></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="md:w-4/12">
                <div class="app-panel side-section">
                    <h5>Action</h5>
                </div>

                <div class="app-panel side-section">
                    <h1>Status</h1>
                    <div class="mb-[10px]">
                        <label>Match Time</label>
                        <select v-model="tipForm.status" class="w-[95%] rounded text-black">
                            <option value="pending">Pending</option>
                            <option value="live">Live</option>
                            <option value="finished">Finished</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="suspended">Suspended</option>
                            <option value="delayed">Delayed</option>
                            <option value="rescheduled">Rescheduled</option>
                        </select>
                    </div>
                    <div class="mb-[10px]">
                        <label>Match Confidence</label>
                        <select v-model="tipForm.match_confidence" class="w-[95%] rounded text-black">
                            <option value="min">Min</option>
                            <option value="medium">Medium</option>
                            <option value="max">Max</option>
                        </select>
                    </div>
                    <div class="mb-[10px]">
                        <label>Winning status</label>
                        <select v-model="tipForm.winning_status" class="w-[95%] rounded text-black">
                            <option value="Won">Won</option>
                            <option value="Lost">Lost</option>
                            <option value="Undefined">Undefined</option>
                        </select>
                    </div>
                </div>

                <div class="app-panel side-section">
                    <h1>Stats</h1>
                    <ul>
                        <li>
                            <p>Winning</p>
                            <p>{{ tip.winning_status ?? 'N/A' }}</p>
                        </li>
                        <li>
                            <p>Accuracy</p>
                            <p>{{ parseInt(tip.predictions_accuracy) }}%</p>
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
