<script setup>
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";
import HomeTipsDisplay from "@/Pages/HomeTipsDisplay.vue";

const props = defineProps(['tips'])
</script>

<template>
    <Navigation/>
    <div class="banner container flex justify-between flex-col md:flex-row mb-[20px] gap-2 mx-auto rounded">
        <div class="grid place-items-center rounded overflow-hidden ratio-1x1 md:w-1/2">
            <img src="/storage/System/content/banners/banner1.png">
        </div>
        <div class="w-[100%] md:w-1/2">
            <div class="h-[50%] mb-[10px] flex gap-x-[10px]">
                <div class="w-[50%] rounded overflow-hidden">
                    <img src="/storage/System/content/banners/tips-banner.png">
                </div>
                <div class="w-[50%] flex flex-column relative justify-center items-center gap-0 rounded overflow-hidden">
                    <img class="w-100 h-100 object-cover" src="/storage/System/content/banners/tips-banner.png">
                    <div class="absolute top-0 left-0  z-2 w-100 h-100 flex justify-center items-center" style="background-color: rgba(0,0,0,.8)">
                        <h2 class="text-center text-white">Get Daily Tips<br> for as low as<br> <span class="text-orange-500 text-[8s0px]">15/-</span></h2>
                    </div>
                </div>
            </div>
            <div class="rounded overflow-hidden">
                <JackpotCarousel/>
            </div>
        </div>
    </div>

    <div class="content-holder container py-[30px]">
        <h1 class="mb-[40px] text-white text-center">Today's Free tips</h1>
        <ul class="mb-[20px] mx-0 p-0">
            <HomeTipsDisplay v-if="tips && tips.length > 0" v-for="item in tips" :tip="item" :key="item.id"/>
            <p v-else class="text-white h2 text-center bg-gray-600 rounded-sm py-[100px]">No Free Tips Available</p>
        </ul>
        <button class="action-button mx-auto block text-white bg-gray-600 hover:bg-orange-500 rounded-sm">More Tips</button>
    </div>
    <app-footer-main/>
</template>

<style lang="scss" scoped>
.banner {
    h1 {
        @apply text-white
    }
}
.content-holder{
    @apply mb-[20px] bg-gray-800 rounded  mx-auto;

    h1{
        @apply mb-[40px] text-white;
    }

    ul{
        @apply mb-[20px] w-full
    }
}
</style>
