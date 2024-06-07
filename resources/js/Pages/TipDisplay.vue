<script setup>

import {formatDate} from "../HelperFunctions/dateReformat.js";

const props = defineProps(['item'])

</script>

<template>
    <li class="container bg-gray-600 rounded list-none shadow-sm pt-[20px] px-[20px] mb-[20px] pb-[20px] lg:flex lg:px-0 lg:py-1">
        <div class="lg:w-6/12 lg:gap-2.5  h-[100%] lg:mb-0 lg:p-[10px] lg:border-r lg:border-r-gray-500">
            <div class="flex justify-around items-center md:mb-[10px]">
                <div class="bg-white rounded w-[60px] h-[60px] p-[5px]">
                    <img :src="'/storage/System/TeamLogos/' + item.home_logo" alt="image">
                </div>
                <div>VS</div>
                <div class="bg-white rounded w-[60px] h-[60px] p-[5px]">
                    <img :src="'/storage/System/TeamLogos/' + item.away_logo" alt="image">
                </div>
            </div>
            <div class="chart-display hidden md:flex flex-col">
                <section>
                    <p class=""> {{ item.home_teams }}</p>
                    <ul>
                        <li>W</li>
                        <li>L</li>
                        <li>D</li>
                        <li>D</li>
                        <li>D</li>
                    </ul>
                </section>
                <section>
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
        <div class="lg:w-3/12 lg:border-r lg:border-r-gray-500  lg:flex lg:items-center lg:justify-center lg:flex-col lg:mb-0">
            <p class="text-center">{{ formatDate(item.match_start_time) }}</p>
            <p class="text-center">12:00Pm</p>
        </div>
        <div class="lg:w-3/12 h-full self-center px-[20px]">
            <div class="relative z-[100]">
                <div class="bg-green-500 rounded py-[10px] text-white text-center h-full">HOME</div>
                <div
                    class="glass absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full">
                    <div>
                    </div>
                </div>
                <div
                    class="z-[200] absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full">
                    <div
                        class="bg-orange-400 mx-[20px] rounded px-[15px] h-full flex items-center justify-center">
                        Get Tip
                    </div>
                </div>
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
        @apply flex;
        p{
            @apply bg-red-300;
        }
        ul {
            @apply flex justify-around w-full mb-[10px];

            li {
                @apply text-center bg-red-400 h-[25px] w-[25px] rounded-[50%] flex items-center justify-center text-sm;
            }
        }
    }
}

.glass {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    opacity: 0.6;
}
</style>
