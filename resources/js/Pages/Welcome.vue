<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import TipDisplay from "@/AppComponents/Global/TipDisplay.vue";
import MatchHistory from "@/AppComponents/Home/Welcome/MatchHistory.vue";
import UpcomingMatch from "@/AppComponents/Home/Welcome/UpcomingMatch.vue";
import {site_summary} from "@/AppComponents/Home/Welcome/DataFile.js";

const props = defineProps(['tips', 'upcoming'])
</script>

<template>
    <HomeLayout>
        <div class="banner">
            <div >
                <div>
                    <img src="/storage/System/Icons/logo-dark.png" class="w-[100px] mb-[20px] md:hidden mx-auto" alt="logo">
                    <h2 class="text-white text-[20px] mb-[30px] font-semibold text-center md:text-[30px] md:px-[20px] md:text-left">
                        Home of Premium League <br> betting tips</h2>
                    <p class="text-white px-[10px] mb-[10px] text-center text-[12px] md:text-[15px] md:px-[20px] md:text-left">
                        Get the latest winning tips from Tips moto and become an expert <br class="hidden md:block"> in
                        sports betting</p>
                </div>
                <UpcomingMatch :upcoming></UpcomingMatch>
            </div>
        </div>
        <div class="container px-[20px]">
            <div class="container app-panel p-[10px] rounded">
                <div class="app-panel-heading flex justify-center"><h1>TIPS MOTO BETTING TIPS</h1></div>
                <div class="content-area p-[10px] text-white text-sm">
                    <p class="mb-[30px] text-center">{{site_summary}}</p>
                </div>
            </div>

            <div v-if="tips != null && tips.length > 0" class="container app-panel p-[10px] rounded mb-[20px] text-white">
                <div class="app-panel-heading flex justify-center mb-[20px]"><h1>TODAY'S FREE TIPS</h1></div>
                <ul class="mx-auto max-w-[800px] mb-[30px]">
                    <li v-for="tip in tips">
                        <tip-display :item="tip"></tip-display>
                    </li>
                </ul>
                <div class="flex">
                    <Link :href="route('packages')"
                        class="inline-block mx-auto bg-orange-400 px-[30px] py-[4px] rounded-sm mb-[50px]">
                        GET MORE
                    </Link>
                </div>
            </div>

            <div v-if="tips != null && tips.length > 0" class="container app-panel p-[10px] rounded mb-[20px]">
                <div class="app-panel-heading flex justify-center"><h1>PREVIOUS MATCHES</h1></div>
                <MatchHistory :tips/>
            </div>

        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.banner {
    background-image: url("/storage/app/public/System/banner.png");
    @apply h-[calc(100vh_-_80px)] mb-[40px] bg-cover bg-center
    md:max-h-[400px]
    xl:max-w-[1200px] xl:mx-auto xl:mt-[10px] xl:rounded xl:overflow-hidden;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
        @apply h-full p-[20px] grid place-items-center md:flex;
    }
}

</style>
