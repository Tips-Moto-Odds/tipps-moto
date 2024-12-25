<script setup xmlns="http://www.w3.org/1999/html">
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";
import HomeTipsDisplay from "@/Pages/HomeTipsDisplay.vue";

const props = defineProps(['tips'])
</script>

<template>
    <Navigation/>
<!--    <div class="banner container flex justify-content-between mb-[20px] mx-auto rounded">-->
<!--        <div class=" h-[410px] w-[500px] grid place-items-center rounded overflow-hidden">-->
<!--            <img class="max-w-[100%] max-h-[100%]" src="/storage/System/content/banners/banner1.png">-->
<!--        </div>-->
<!--        <div class="w-[calc(100%-510px)] h-[400px] ">-->
<!--            <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">-->
<!--                <div class="w-[50%] h-[100%] rounded bg-gray-400">-->
<!--                    <img src="storage">-->
<!--                </div>-->
<!--                <div class="w-[50%] flex flex-column relative justify-center items-center gap-0 h-[100%] rounded ">-->
<!--                    <img class="w-100 h-100 object-cover" src="/storage/System/content/banners/tips-banner.png">-->
<!--                    <div class="absolute top-0 left-0  z-2 w-100 h-100 flex justify-center items-center" style="background-color: rgba(0,0,0,.8)">-->
<!--                        <h2 class="text-center text-white">Get Daily Tips<br> for as low as<br> <span class="text-orange-500 text-[8s0px]">15/-</span></h2>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="w-[100%] h-[50%] rounded overflow-hidden">-->
<!--                <JackpotCarousel/>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="content-holder container">-->
<!--        <h1 class="mb-[40px] text-white">Today's Free tips</h1>-->
<!--        <ul class="mb-[20px]">-->
<!--            <HomeTipsDisplay v-if="tips && tips.length > 0" v-for="item in tips" :tip="item" :key="item.id"/>-->
<!--            <p v-else class="text-white h2 text-center bg-gray-600 rounded py-[100px]">No Free Tips Available</p>-->
<!--        </ul>-->
<!--        <button class="action-button text-white bg-gray-600 hover:bg-orange-500 rounded">More Tips</button>-->
<!--    </div>-->
<!--    <app-footer-main/>-->
</template>

<style lang="scss" scoped>
.banner {
    h1 {
        @apply text-white
    }
}
.content-holder{
    @apply flex flex-col items-center justify-center mb-[20px] mx-auto bg-gray-800 rounded p-[30px];

    h1{
        @apply mb-[40px] text-white;
    }

    ul{
        @apply mb-[20px] w-full
    }
}
</style>
