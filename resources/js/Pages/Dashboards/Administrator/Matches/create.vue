<script setup>
import {Link, router, useForm, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {onMounted, reactive, ref} from "vue";
import CreateTipForm from "@/Pages/Dashboards/Administrator/Tips/CreateTipForm.vue";

const props = defineProps(['tip'])
const page = usePage()
const accountType = 'SuperAdministration'
const extra_odds = ref([]);
const matchForm = useForm({
    league: "Premier League",
    home_team: "Tottenham",
    away_team: "Liverpool",
    match_start_time: "2024-12-24T23:34",
})
const createMatch = () => {
    matchForm.post('dashboard.matches.addMatch')
}
</script>


<template>
    <DashboardLayout page-heading="View Tip" title="View Tip">
        <div class="w-[98%] flex mb-[20px] text-white items-center mx-auto gap-2.5 justify-between text-sm">
            <div>
                <Link as="button" :href="route('dashboard.matches.listMatches')" class="action-button bg-gray-500 hover:bg-orange-500">View All tips</Link>
            </div>
            <div class="flex gap-x-2 ">
                <button class="action-button bg-blue-600 hover:bg-blue-600/50 " @click.prevent="createMatch">Save</button>
            </div>
        </div>
        <div class="md:flex w-[98%]  mx-auto gap-3 text-white px-[5px]">
            <div class="md:w-8/12">
                <div class="app-panel">
                    <div class="app-panel-heading flex justify-between">
                        <h5>Match Details</h5>
                    </div>
                    <CreateTipForm :matchForm/>
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
