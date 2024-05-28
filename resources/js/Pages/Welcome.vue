<script setup>
import MobilMenu from "@/Layouts/HomeLayout/Mobil-Menu.vue";
import MenuPanel from "@/Layouts/HomeLayout/Menu-panel.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";
import { Head } from '@inertiajs/vue3'
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";



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
        <div class="container md:flex">
            <div class="container text-white bg-gray-500] px-[20px]">
                <h1 class="mb-[20px] font-bold">Top Matches</h1>
                <ul>
                    <li v-for="item in 5" class="container bg-gray-600 rounded list-none shadow-sm pt-[20px] px-[20px] mb-[20px] pb-[20px]
                                lg:flex lg:px-0 lg:py-1
                            ">
                        <div
                            class="mb-[20px] lg:gap-2.5 lg:w-5/12 h-[100%] lg:mb-0 lg:p-[10px] lg:border-r lg:border-r-gray-500">
                            <div class="flex justify-around items-center md:mb-[10px]">
                                <div class="bg-white rounded w-[60px] h-[60px]"></div>
                                <div>VS</div>
                                <div class="bg-white rounded w-[60px] h-[60px]"></div>
                            </div>
                            <div class="min-w-240px chart-display hidden md:flex">
                                <section>
                                    <p>Home</p>
                                    <ul>
                                        <li>W</li>
                                        <li>L</li>
                                        <li>D</li>
                                        <li>D</li>
                                        <li>D</li>
                                    </ul>
                                </section>
                                <section>
                                    <p>Away</p>
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
                        <div class="mb-[20px] lg:hidden">
                            <hr class="border-[1px] border-gray-500">
                        </div>
                        <div class="mb-[20px] lg:border-r lg:border-r-gray-500 lg:w-2/12 lg:flex lg:items-center lg:justify-center lg:flex-col lg:mb-0">
                            <p class="text-center">Sat, May 1<span class="text-sup">st</span></p>
                            <p class="text-center">12:00Pm</p>
                        </div>
                        <div class="mb-[20px] lg:hidden">
                            <hr class="border-[1px] border-gray-500">
                        </div>
                        <div  class="lg:w-5/12 h-full self-center px-[20px]">
                            <div class="relative z-[100]">
                                <div class="bg-green-500 rounded py-[10px] text-white text-center h-full">HOME</div>
                                <div class="glass absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full">
                                    <div>
                                    </div>
                                </div>
                                <div class="z-[200] absolute top-0 w-[100%] rounded py-[10px] text-white text-center h-full">
                                    <div class="bg-orange-400 mx-[20px] rounded px-[15px] h-full flex items-center justify-center">Get Tip</div>
                                </div>
                            </div>
                        </div>

                    </li>
                </ul>
            </div>
            <div class="container text-white bg-gray-500] px-[20px] md:w-[500px]">
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
        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.chart-display {
    @apply flex-col text-sm;

    section {
        @apply flex;
        & > p {
            @apply w-[100px]
        }

        ul {
            @apply flex justify-around w-full mb-[10px];

            li {
                @apply text-center bg-red-400 h-[25px] w-[25px] rounded-[50%] flex items-center justify-center text-sm;
            }
        }
    }
}


.banner {
    background-image:    url("/storage/app/public/System/banner.png");
    background-size:     cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

.glass {
    background:              linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
    backdrop-filter:         blur(20px);
    -webkit-backdrop-filter: blur(10px);
    border:                  1px solid rgba(255, 255, 255, 0.18);
    box-shadow:              0 8px 32px 0 rgba(0, 0, 0, 0.37);
    opacity:                 0.6;
}
</style>
