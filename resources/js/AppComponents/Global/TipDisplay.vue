<script setup>

import {formatDate,formatAMPM} from "../../HelperFunctions/dateReformat.js";


const props = defineProps(['item'])
const emit = defineEmits(['purchaseTip'])

</script>

<template>
    <li class="container bg-gray-600 text-white rounded list-none shadow-sm pt-[20px] px-[20px] mb-[20px] pb-[20px] lg:flex lg:px-0 lg:py-1">
        <div class="lg:w-7/12 lg:gap-2.5  h-[100%] lg:mb-0 lg:p-[10px] lg:border-r lg:border-r-gray-500">
            <div class="flex justify-around items-center md:mb-[20px]">
                <div class="bg-white rounded w-[60px] h-[60px] flex items-center justify-center">
                    <img class="h-[60px] p-[1px] w-[60px] object-contain object-center" :src="'/storage/System/TeamLogos/' + item.home_logo" alt="image">
                </div>
                <div>VS</div>
                <div class="bg-white rounded w-[60px] h-[60px]">
                    <img class="h-[60px] p-[1px] w-[60px] object-contain object-center" :src="'/storage/System/TeamLogos/' + item.away_logo" alt="image">
                </div>
            </div>
            <div class="chart-display hidden md:block">
                <section class="flex justify-between">
                    <p> {{ item.home_teams }}</p>
                    <ul>
                        <li>W</li>
                        <li>L</li>
                        <li>D</li>
                        <li>D</li>
                        <li>D</li>
                    </ul>
                </section>
                <section class="flex justify-between">
                    <p>{{ item.away_teams }}</p>
                    <ul>
                        <li>L</li>
                        <li>D</li>
                        <li>D</li>
                        <li>W</li>
                        <li>D</li>
                    </ul>
                </section>
            </div>
        </div>
        <div class="lg:w-2/12 lg:border-r lg:border-r-gray-500  lg:flex lg:items-center lg:justify-center lg:flex-col lg:mb-0">
            <p class="text-center">{{ formatDate(item.match_start_time) }}</p>
            <p class="text-center">{{formatAMPM(item.match_start_time)}}</p>
        </div>
        <div class="lg:w-3/12 h-full self-center px-[20px]">
            <div class="relative z-[100]">
                <div class="bg-green-500 rounded py-[5px] text-white text-center h-full">{{item.predictions == 0 ? 'X' : item.predictions}}</div>
            </div>
        </div>
    </li>
</template>

<style scoped lang="scss">
.container {
    & > div {
        @apply mb-[20px];
    }
}

.chart-display {
    @apply text-sm;

    section {
        @apply flex my-[10px] px-[20px];

        ul {
            @apply flex justify-around mb-[10px] gap-2.5;

            li {
                @apply text-center bg-red-400 h-[20px] w-[20px] rounded-[50%] flex items-center justify-center text-[10px];
            }
        }
    }
}
</style>
