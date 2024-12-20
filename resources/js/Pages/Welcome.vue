<script setup xmlns="http://www.w3.org/1999/html">
import Navigation from "@/AppComponents/Navigation.vue";
import {applyBackGroundOrange} from "@/HelperFunctions/appFunctions.js";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

applyBackGroundOrange()

</script>

<template>
    <Navigation/>
    <div class="banner container flex justify-content-between mb-[20px] mx-auto rounded">
        <div class=" h-[410px] w-[500px] grid place-items-center rounded">
            <p class="text-[82px] text-white">
                Tips Moto <br>Vi Simple
            </p>
        </div>
        <div class="w-[calc(100%-510px)] h-[400px] ">
            <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">
                <div class="w-[50%] h-[100%] rounded "></div>
                <div class="w-[50%] flex flex-column justify-center items-center gap-0 h-[100%] rounded ">
                    <h1>Get Daily Tips</h1>
                    <h1>for as low as</h1>
                    <h1 class="!text-orange-400">15/-</h1>
                </div>
            </div>
            <div class="w-[100%] h-[50%] rounded grid place-items-center">
                <p class="text-white text-center">Small text about jackpots.<br>
                    should link to jackpots section on tips page<br>
                </p>
            </div>
        </div>
    </div>

    <div class="free-tips-section container flex flex-column items-center justify-center mb-[20px] mx-auto bg-gray-300 rounded p-[30px]">
        <h1 class="mb-[20px]">Free tips section</h1>
        <ul class="mb-[20px]">
            <li v-for="item in 3" class="min-w-[600px] mb-[15px] justify-between items-center lg:max-w-[400px] py-[10px] bg-orange-400 flex  rounded  px-[10px]">
                <div class="w-[100px] flex-column flex justify-center items-center">
                    <p>Team A</p>
                    <p>Team B</p>
                </div>
                <div class="w-[100px] flex-column flex items-center">
                    <p>Mon 9 Dec</p>
                    <p>20:30</p>
                </div>
                <div class="w-[100px] flex-column flex ">
                    <p class="px-[10px] !py-[6px]  rounded bg-black text-center text-white">Home Win</p>
                </div>
            </li>
        </ul>
        <button class="px-[13px] py-[4px] rounded-md bg-[#201B1B] text-orange-400">More Tips</button>
    </div>
    <div class="previous-tips container flex flex-column items-center justify-center mb-[20px] mx-auto bg-gray-300 rounded p-[30px]">
        <h1 class="mb-[20px]">Previous Tips</h1>
        <ul class="mb-[20px]">
            <li v-for="item in 6" class="min-w-[600px] mb-[15px] justify-between items-center lg:max-w-[400px] py-[10px] bg-orange-400 flex  rounded  px-[10px]">
                <div class="w-[100px] flex-column flex justify-center items-center">
                    <p>Team A</p>
                    <p>Team B</p>
                </div>
                <div class="w-[100px] flex-column flex items-center">
                    <p>Mon 9 Dec</p>
                    <p>20:30</p>
                </div>
                <div class="w-[100px] flex-column flex ">
                    <p class="px-[10px] !py-[6px]  rounded bg-black text-center text-white">Home Win</p>
                </div>
            </li>
        </ul>
    </div>
    <app-footer-main/>
</template>

<style lang="scss" scoped>
.banner {
    h1 {
        @apply text-white
    }

    & > div:first-child {
        @apply bg-black;
        & div {
            @apply bg-black;
        }
    }

    & > div {
        div:last-child {
            @apply bg-black;
        }

        & div > div {
            @apply bg-black;
            div {
                @apply bg-black;
            }
        }
    }
}

.free-tips-section, .previous-tips {
    p {
        @apply p-0 m-0 font-bold;
    }

    @apply bg-black;

    & > h1 {
        @apply text-white;
    }
}
</style>
