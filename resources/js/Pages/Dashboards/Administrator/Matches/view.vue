<script setup>
import {Link, useForm, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import MatchCardBody from "@/Pages/Dashboards/Administrator/Matches/Componsnets/MatchCardBody.vue";
import TipCard from "@/Pages/Dashboards/Administrator/Matches/Componsnets/TipCard.vue";
import FilterPannel from "@/Pages/Dashboards/Administrator/Tips/FilterPannel.vue";
import {closeSideBar, openSideBar} from "@/HelperFunctions/modalControl.js";
import AddTipComponent from "@/Pages/Dashboards/Administrator/Matches/Componsnets/AddTipComponent.vue";
import axios from "axios";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps(['match'])
const tipForm = useForm({
    match_id:props.match.id,
    tip_id:null,
    tip_type:"1-X-2",
    prediction:"Home Win",
    risk_level:"Min",
    winning_status:"Pending",
    mark_as_free:false
})

function handleUpdateTip(tip) {
    tipForm.tip_id = tip.id
    tipForm.tip_type = tip.prediction_type
    tipForm.prediction = tip.predictions
    tipForm.risk_level = tip.prediction_confidence
    tipForm.winning_status = tip.winning_status
    tipForm.mark_as_free = tip.mark_as_free == 1 ? true : false
    openSideBar()
}

function handleAddTip(tip) {
    tipForm.reset()
    openSideBar()
}

function deleteMatch(){
    axios.delete(route('dashboard.matches.deleteMatch',[props.match.id]))
    .then((response) => {
        Inertia.visit(route('dashboard.matches.listMatches'))
    })
}

</script>


<template>
    <DashboardLayout page-heading="View Match" title="View Match">
        <template v-slot:side>
            <FilterPannel  title="Add Tip" @close="closeSideBar">
                <AddTipComponent :matchId="match.id" :tipForm />
            </FilterPannel>
        </template>
        <div class="w-[98%] flex mb-[20px] text-white items-center mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link as="button" :href="route('dashboard.matches.listMatches')" class="action-button bg-gray-500 hover:bg-orange-500">View All matchs</Link>
            </div>
            <div class="flex gap-x-2">
                <Link as="button" :href="route('dashboard.matches.updateMatch',[match.id])" class="action-button bg-blue-500 hover:bg-blue-500/50 mx-[10px]">Update</Link>
                <button class="action-button bg-red-600 hover:bg-red-600/50" @click.prevent="deleteMatch">Delete match</button>
            </div>
        </div>
        <div class="md:flex w-[98%]  mx-auto gap-3 text-white px-[5px]">
            <div class="w-full">
                <MatchCardBody :match="match"></MatchCardBody>
                <div class="app-panel">
                    <div class="app-panel-heading mb-[20px] items-center flex justify-between ">
                        <h3 class="m-0 p-0">Tips</h3>
                        <div>
                            <button class=" bg-blue-500 py-1 px-2 rounded-sm m-0" @click.prevent="handleAddTip()">Add Tip</button>
                        </div>
                    </div>
                    <div class="app-panel-body flex gap-2" v-if="match.tips.length > 0">
                        <TipCard v-for="tip in match.tips" :key="tip.id" :tip="tip" @update:tip="handleUpdateTip"></TipCard>
                    </div>
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
