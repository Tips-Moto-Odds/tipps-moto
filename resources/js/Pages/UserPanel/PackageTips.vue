<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import {useDateFormat} from "@vueuse/shared";

const props = defineProps(['tips'])
let tips = []

if (props.tips && props.tips.tips){
    tips = JSON.parse(props.tips.tips);
}
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="container flex flex-col md:flex-row text-white flex gap-2">
        <div class=" w-full bg-black p-[20px]">
            <h1 class="mb-[10px]">Tips</h1>
            <hr class="border border-white bg-white"/>
            <div class="flex flex-col md:flex-row md:flex-wrap gap-[10px] mb-[20px] justify-between items-center">
                <ul v-if="tips.length > 0" v-for="(item,index) in tips" class="p-0 m-0 overflow-hidden rounded max-w-[300px]">
                    <li class="w-[300px] bg-gray-500">
                        <div class="flex">
                            <p class="m-0 p-[10px] w-[100px]">{{index+1}}</p>
                            <h6 class="text-center py-[10px]">{{ useDateFormat(tips.match_start_time, 'ddd, D MMM')}}</h6>
                            <div></div>
                        </div>
                        <div class="flex justify-center gap-2">
                            <p>{{item.home_teams}}</p>
                            <p>vs</p>
                            <p>{{item.away_teams}}</p>
                        </div>
                        <div class="flex justify-between px-[10px] py-[8px]">
                            <p class="bg-orange-600 mx-auto px-[20px] py-[8px] rounded-sm inline-block ">{{item.predictions}}</p>
                        </div>
                    </li>
                </ul>
                <p v-else>No active Tips Available Today. Please try again later</p>
            </div>
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
