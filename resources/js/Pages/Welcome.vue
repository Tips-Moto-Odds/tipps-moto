<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import Pagination from "@/AppComponents/Pagination.vue";
import TipDisplay from "@/Pages/TipDisplay.vue";

const props = defineProps(['tips', 'upcoming'])

</script>

<template>
    <HomeLayout>
        <div
            class="h-[calc(100vh_-_80px)] mb-[40px] banner xl:max-w-[1200px] xl:mx-auto xl:mt-[10px] xl:rounded xl:overflow-hidden md:max-h-[400px]">
            <div class="w-full h-full flex flex-col items-center justify-center  px-[20px] md:flex-row ">
                <div class="md:w-1/2">
                    <img src="/storage/System/Icons/logo-dark.png" class="w-[100px] mb-[20px] md:hidden" alt="logo">
                    <h2 class="text-white text-[20px] mb-[30px] font-semibold text-center md:text-[30px] md:px-[20px] md:text-left">
                        Home of Premium League <br> betting tips</h2>
                    <p class="text-white px-[10px] mb-[10px] text-center text-[12px] md:text-[15px] md:px-[20px] md:text-left">
                        Get the latest winning tips from Tips moto and become an expert <br class="hidden md:block"> in
                        sports betting</p>
                </div>
                <div class="container  bg-gray-900 bg-red rounded text-white md:w-1/2">
                    <h3 class="text-center pt-[10px] mb-[20px] md:text-2xl md:mb-[0px]">Up Coming</h3>
                    <div
                        class="flex justify-around items-center mb-[20px] md:mb-[10px] md:h-[200px] md:max-w-[450px] mx-auto">
                        <div>
                            <div class="w-[80px] h-[80px] rounded bg-white">
                                <img :src="'/storage/System/TeamLogos/' + upcoming.home_logo" alt="image">
                            </div>
                        </div>
                        <div>
                            <p>VS</p>
                        </div>
                        <div>
                            <div class="w-[80px] h-[80px] bg-white rounded">
                                <img :src="'/storage/System/TeamLogos/' + upcoming.away_logo" alt="image">
                            </div>
                        </div>
                    </div>
                    <div class="text-white text-[14px] text-center mb-[10px]">
                        <p>May 1st 2024</p>
                        <p>12:00Pm</p>
                    </div>
                    <div class="flex justify-center mb-[10px]">
                        <a class="bg-orange-500 px-[30px] py-[10px] rounded" href="/">GET TIP</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container md:flex">
            <div class="container text-white bg-gray-500] px-[20px]">
                <h1 class="mb-[20px] font-bold">Top Matches</h1>
                <ul>
                    <tip-display v-for="item in tips.data" :item="item"/>
                </ul>
                <Pagination :pagination="tips.links"/>
            </div>
            <div class="container text-white bg-gray-500] px-[20px] md:w-[500px]">
                <h1 class="mb-[20px] font-bold">High Lights</h1>
                <ul>
                    <li v-for="item in 3" class="mb-[20px]">
                        <div class="bg-gray-600  p-[10px] rounded">
                            <div class="w-full h-[200px] rounded  ">

                            </div>
                            <h2>Fantacy Show: Experts Double Gameweek 35 teams</h2>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.banner {
    background-image: url("/storage/app/public/System/banner.png");
    background-size: cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

</style>
