<script setup xmlns="http://www.w3.org/1999/html">
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";



</script>

<template>
    <Navigation/>
    <div class="banner container flex justify-content-between mb-[20px] mx-auto rounded">
        <div class=" h-[410px] w-[500px] grid place-items-center rounded overflow-hidden">
            <img class="max-w-[100%] max-h-[100%]" src="/storage/System/content/banners/banner1.png">
        </div>
        <div class="w-[calc(100%-510px)] h-[400px] ">
            <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">
                <div class="w-[50%] h-[100%] rounded bg-gray-400">
                </div>
                <div class="w-[50%] flex flex-column relative justify-center items-center gap-0 h-[100%] rounded ">
                    <img class="w-100 h-100 object-cover" src="/storage/System/content/banners/tips-banner.png">
                    <div class="absolute top-0 left-0  z-2 w-100 h-100 flex justify-center items-center" style="background-color: rgba(0,0,0,.8)">
                        <h2 class="text-center text-white">Get Daily Tips<br> for as low as<br> <span class="text-orange-500 text-[8s0px]">15/-</span></h2>
                    </div>
                </div>
            </div>
            <div class="w-[100%] h-[50%] rounded overflow-hidden">
                <JackpotCarousel/>
            </div>
        </div>
    </div>

    <div class="free-tips-section container flex flex-column items-center justify-center mb-[20px] mx-auto bg-gray-800 rounded p-[30px]">
        <h1 class="mb-[40px] text-white">Today's Free tips</h1>
        <ul class="mb-[20px] w-[800px]">
            <li v-for="item in 3" class=" text-white  p-[10px] bg-gray-500  rounded mb-[10px]">
                <section>
                    <div>
                        <p class="h5">League:</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex-column flex justify-center items-center">
                            <p>Team A</p>
                            <p>Team B</p>
                        </div>
                        <div class=" flex-column flex items-center">
                            <p>Mon 9 Dec</p>
                            <p>20:30</p>
                        </div>
                        <div class=" flex-column flex ">
                            <p class="px-[10px] !py-[6px]  rounded bg-black text-center text-white">Home Win</p>
                        </div>
                    </div>
                </section>
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
}
</style>
