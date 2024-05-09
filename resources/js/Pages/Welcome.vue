<script setup>
import MobilMenu from "@/AppComponents/Mobil-Menu.vue";
import MenuPanel from "@/AppComponents/Menu-panel.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";

const handleOpening = () => $("#main-site-menu").css('right','100%')
const handelClosing = () => $('#main-site-menu').css('right','0%')

</script>

<template>
    <MobilMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobilMenu>
    <menu-panel></menu-panel>
    <div class="h-[calc(100vh_-_80px)] mb-[40px] banner">
        <div class=" w-full h-full flex items-center justify-center flex-col px-[20px]" >
            <img src="/storage/System/Icons/logo-dark.png" class="w-[100px] mb-[20px]" alt="logo">
            <h2 class="text-white text-[20px] mb-[30px] font-semibold text-center">Home of Premium League <br> betting tips</h2>
            <p class="text-white px-[10px] mb-[10px] text-center text-[12px]">Get the latest winning tips from Tips moto and become an expert in sports betting</p>
            <div class="container bg-gray-900 bg-red rounded text-white">
                <h3 class="text-center pt-[10px] mb-[20px]">Up Coming</h3>
                <div class="flex justify-around items-center mb-[20px]">
                    <div>
                        <div class="w-[80px] h-[80px] rounded bg-white">

                        </div>
                    </div>
                    <div>
                        <p>VS</p>
                    </div>
                    <div>
                        <div class="w-[80px] h-[80px] bg-white rounded">

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
    <div class="container text-white bg-gray-500] px-[20px]">
        <h1 class="mb-[20px] font-bold">Top Matches</h1>
        <ul>
            <li v-for="item in 5" class="container bg-gray-600 rounded list-none shadow-sm pt-[20px] px-[20px] mb-[20px] pb-[20px]">
                <div class="flex justify-around items-center mb-[20px]">
                    <div class="bg-white rounded w-[80px] h-[80px]"></div>
                    <div>VS</div>
                    <div class="bg-white rounded w-[80px] h-[80px]"></div>
                </div>
                <div class="mb-[20px]">
                    <hr class="border-[1px] border-gray-500">
                </div>
                <div class="mb-[20px]">
                    <p class="text-center">Sat, May 1<span class="text-sup">st</span></p>
                    <p class="text-center">12:00Pm</p>
                </div>
                <div class="mb-[20px]">
                    <hr class="border-[1px] border-gray-500">
                </div>
                <div class="relative z-[100]">
                    <div class="bg-green-500 rounded py-[10px] text-white text-center">HOME</div>
                    <div class="glass absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full" >
                        <div>
                        </div>
                    </div>
                    <div class="z-[200] absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full" >
                        <div class="bg-orange-400 mx-[20px] rounded px-[15px]">Get Tip</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="container text-white bg-gray-500] px-[20px]">
        <h1 class="mb-[20px] font-bold">High Lights</h1>
        <ul>
            <li v-for="item in 3" class="mb-[20px]">
                <div class="bg-gray-600  p-[10px] rounded">
                    <div class="w-full bg-orange-500 h-[200px] rounded">

                    </div>
                    <h2>Fantacy Show: Experts Double Gameweek 35 teams</h2>
                </div>
            </li>
        </ul>
    </div>
    <app-footer/>
</template>

<style scoped lang="scss">
.banner{
    background-image: url("/storage/app/public/System/banner.png");
    background-size: cover;
    background-position: center;
    &>div{
        background-color: rgba(0,0,0,0.7);
    }
}
.glass{
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(10px);
    border:1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    opacity: 0.6;
}
</style>
