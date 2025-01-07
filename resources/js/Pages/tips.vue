<script setup>
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {applyBackGroundOrange} from "@/HelperFunctions/appFunctions.js";

applyBackGroundOrange()

</script>

<template>
    <Navigation/>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-gray-600 rounded">
        <h1 class="text-center py-[20px]">Full-Time Scores</h1>
        <p class="px-[30px] mb-[30px] text-center">Full-Time Scores tips involve inferring the likely outcome of a match at the end of regular playing time. Whether it's a thrilling 2-1 victory or a
            close 0-0 draw, Tips Moto delivers meticulously analyzed forecasts . Our team of experts leverages in-depth statistics, team form, and match-day factors to offer you high-probability
            outcomes, ensuring you bet with confidence.</p>
        <div class="mb-[20px] flex flex-col gap-10 md:flex-row items-center justify-center py-[20px]">
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                <img src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
            </div>
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                <img src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
            </div>
        </div>
    </div>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-gray-600 rounded">
        <h1 class="text-center py-[20px]">Over & Under Markets</h1>
        <p class="px-[30px] mb-[30px] text-center">Overs and Unders
            This parameter focuses on forecasting whether the total goals scored in a match will be above or below a specified number (e.g., Over 2.5 or Under 2.5 goals). At Tips Moto, we provide
            data-driven insights into team scoring trends, head-to-head records, and defensive strengths, helping you make informed decisions for this highly popular betting market.</p>
        <div class="mb-[20px] flex flex-col gap-10 md:flex-row  items-center justify-center">
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                <img src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
            </div>
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded overflow-hidden">
                <img src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
            </div>
        </div>
    </div>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-gray-600 rounded">
        <h1 class="text-center py-[20px]">Jackpot Tips</h1>
        <p class="px-[30px] mb-[30px] text-center">Jackpot Tips involve inferring the outcomes of a series of matches, typically 13-20 fixtures. These are high-stakes picks that require precision and
            comprehensive analysis. Tips Moto combines expert opinions, advanced algorithms, and statistical modeling to maximize your chances of hitting the jackpot, making even the toughest
            predictions more approachable.</p>
        <div class="container flex flex-col md:flex-row justify-content-between gap-2 mb-[20px] mx-auto rounded">
            <div class="bg-gray-50 w-full md:w-1/2 rounded overflow-hidden">
                <img class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/weekly_jackpot.png">
            </div>
            <div class="w-full md:w-1/2  flex flex-col rounded gap-2">
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="rounded bg-gray-400 w-100 overflow-hidden">
                        <img class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
                    </div>
                    <div class="rounded bg-gray-400 w-100 overflow-hidden">
                        <img class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
                    </div>
                </div>
                <div class="flex flex-col md:flex-row h-50 gap-2">
                    <div class="w-100 overflow-hidden  md:h-[100%] rounded bg-gray-400 grid place-items-center">
                        <img class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
                    </div>
                    <div class="w-100 overflow-hidden md:h-[100%] rounded bg-gray-400 grid place-items-center">
                        <img class="w-full h-full object-cover" src="storage/System/content/Tips/Banners/mid-week_jackpot.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <app-footer-main/>
</template>

<style scoped lang="scss">
.main-card-container {
    h1 {
        @apply text-white;
    }

    p {
        @apply text-white
    }
}

.footer {
    section:first-of-type {
        div {
            @apply p-[10px] w-[200px];

            li {
                @apply text-black;
            }
        }
    }
}
</style>

