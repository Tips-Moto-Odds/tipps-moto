<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import {useDateFormat} from "@vueuse/shared";
import HomeTipsDisplay from "@/AppComponents/HomeTipsDisplay.vue";

// const props = defineProps(['tips'])
// let tips = []
//
// if (props.tips && props.tips.tips) {
//     tips = JSON.parse(props.tips.tips);
// }

const tips = [
    {
        home_teams: 'monchengladbach',
        away_teams: 'Liverpool',
        match_start_time:'2025-01-27 22:30:00',
        prediction_type:'1-X-2',
        predictions:'Home Win'
    },
    {
        home_teams: 'Chealse',
        away_teams: 'Liverpool',
        match_start_time:'2025-01-27 22:30:00',
        prediction_type:'1-X-2',
        predictions:'Home Win'
    },
    {
        home_teams: 'Chealse',
        away_teams: 'Liverpool',
        match_start_time:'2025-01-27 22:30:00',
        prediction_type:'1-X-2',
        predictions:'Home Win'
    },
    {
        home_teams: 'Chealse',
        away_teams: 'Liverpool',
        match_start_time:'2025-01-27 22:30:00',
        prediction_type:'1-X-2',
        predictions:'Home Win'
    }
]
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="container flex flex-col md:flex-row text-white flex gap-2">
        <div class=" w-full bg-black p-[10px]">
            <div class="flex items-center p-0 mb-4 border-bottom rounded-0">
                <h3 class="m-0">Tips</h3>
            </div>
            <div v-if="tips.length > 0" class="rounded flex gap-1 justify-around gap-3 flex-wrap ">
                <HomeTipsDisplay v-for="item in tips" :tip="item" :key="item.id"/>
            </div>
            <p v-else class="text-sm text-center p-[10px] bg-gray-900">No active Tips Available Today. Please try again later</p>
        </div>
    </div>
</template>

<style lang="scss" scoped>

.container {
    div {
        @apply rounded-lg;
    }
}

</style>
