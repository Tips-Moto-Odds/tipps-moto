<script setup>

import {useDateFormat} from "@vueuse/shared";
import {usePage} from "@inertiajs/vue3";

const props = defineProps(['tip'])
const page = usePage();
</script>


<template>
    <div class="text-white  p-[10px] bg-app_gray w-100 md:max-w-[334px] rounded mb-[10px]">
        <section>
            <div class="flex justify-between mb-[10px]">
                <p></p>
                <p>{{ useDateFormat(tip.match_start_time, 'ddd, DD MMM ') }}</p>
                <p></p>
            </div>
            <div class="flex justify-between items-center text-sm mb-[10px]">
                <p class="w-100 text-right">{{ tip.home_teams }}</p>
                <p class="mx-[2px] w-[200px] text-center">
                    <p>{{ useDateFormat(tip.match_start_time, 'HH:mm') }}</p>
                </p>
                <p class="w-100 text-left">{{ tip.away_teams }}</p>
            </div>
            <div class="flex justify-center w-100 md:w-1/3">
                <div v-if="page.props.auth.user == null" class="bg-primary_orange rounded">
                    <p class="rounded  text-center mb-[1px] text-white">
                        <Link href="/login" as="p" class="cursor-pointer px-3 rounded  text-center py-1 text-white">Log In</Link>
                    </p>
                </div>
                <div v-else class="bg-primary_orange rounded w-[108px]">
                    <p v-if="tip.predictions == 1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/X</p>
                    <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">X/2</p>
                    <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1X_X2_12'" class="prediction-card-display">1/2</p>

                    <p v-else-if="tip.predictions == 1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Home</p>
                    <p v-else-if="tip.predictions == 0 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Draw</p>
                    <p v-else-if="tip.predictions == -1 && tip.prediction_type == '1_X_2'" class="prediction-card-display">Away</p>

                    <p v-else-if="tip.predictions == 1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">GG</p>
                    <p v-else-if="tip.predictions == -1 && tip.prediction_type == 'GG-NG'" class="prediction-card-display">NG</p>

                    <p v-else class="text-center mb-[20px]">{{tip.predictions}}</p>
                </div>
            </div>
        </section>
    </div>
</template>

<style lang="scss" scoped>
.prediction-card-display{
    @apply rounded text-center py-1 text-white;
}

</style>
