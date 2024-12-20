<script setup>
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {applyBackGroundGray} from "@/HelperFunctions/appFunctions.js";

// applyBackGroundGray()
</script>

<template>
        <div class="w-[100vw] h-[100vh]  sm:flex-wrap md:flex-nowrap overflow-hidden rounded card-design flex gap-2">
            <div class="w-[100%] md:w-[60%] px-[10px]">
                <div class="bg-black w-fit rounded-lg shadow-lg">
                    <img class="w-[60px] m-[20px]" src="storage/System/Icons/logo-dark.png">
                </div>
                <div class="flex gap-[10px] h-full">
                    <ul>
                        <li class="w-[15px] h-[15px] bg-orange-400 rounded-[50%] mt-[30px] mb-[10px]"></li>
                        <li v-for="item in 3" class="w-[15px] h-[15px] bg-orange-400/25 rounded-[50%] mb-[10px]"></li>
                    </ul>
                    <div class=" w-full h-[750px] overflow-y-hidden">
                        <div class="h-[600px] p-[20px] w-full  mb-[20px] relative">
                            <h1 class="text-[55px] font-[900] mb-[-px]">From Daily Tips</h1>
                            <h4 class="text-gray-500 ml-[2px]">With 90% average accuracy</h4>
                            <div class="w-full h-full  absolute top-0 left-0">
                                <section class=" mt-[100px] w-full h-full relative">
                                    <div style="transform: scale(1.2)" class="w-[244px] top-[calc(55%-50px)] overflow-hidden left-[5%] shadow-lg rounded h-[244px] bg-green-50 absolute">
                                        <img class="w-[244px] h-[310px]" src="storage/System/11th%20DEC%20OUTCOME%201.png">
                                    </div>
                                    <div style="transform: scale(1.2)" class="w-[244px] top-[calc(30%-50px)] overflow-hidden left-[31%] shadow-lg rounded h-[244px] bg-green-50 absolute">
                                        <img class="w-[244px] h-[310px]" src="storage/System/11th%20DEC%20OUTCOME%201.png">
                                    </div>
<!--                                    <div style="transform: scale(1.4)" class="w-[244px] top-[calc(47%-50px)] overflow-hidden left-[58%] shadow-lg rounded h-[244px] bg-green-50 absolute">-->
<!--                                        <img class="w-[244px] h-[310px]" src="storage/System/11th%20DEC%20OUTCOME%201.png">-->
<!--                                    </div>-->
                                </section>
                            </div>
                        </div>
                        <div v-show="false" class="h-[600px] w-full bg-green-300 mb-[20px]">
                            <h1 class="p-[20px] font-bold text-[48px]">To daily Jackpot</h1>

                        </div>
                        <div v-show="false" class="h-[600px] w-full bg-green-300 mb-[20px]">
                            <h1 class="p-[20px] font-bold text-[48px]">From Daily Tips</h1>

                        </div>
                    </div>
                </div>
            </div>
            <form  class="w-[100%] md:w-[40%] flex items-center justify-center">
                <div id="inset-shadow" class="w-[350px] pb-[30px] bg-white rounded-[25px] mb-[10px] ">
                    <div class="bg-orange-500 h-[80px] rounded-tr-[24px] rounded-tl-[24px] flex items-center justify-center px-[20px] mb-[40px]" style="box-shadow: 0 3px 5px ">
                        <p class="text-center font-bold p-0 m-0 text-white">Register today for a chance to <br> win FREE tips for a whole week!</p>
                    </div>
                    <div class="mb-[40px] px-[20px]">
                        <input type="text" class="block mx-auto mb-[20px] w-[80%] rounded-lg bg-gray-100 border-gray-300" placeholder="First Name">
                        <input type="text" class="block mx-auto mb-[20px] w-[80%] rounded-lg bg-gray-100 border-gray-300" placeholder="Last Name">
                        <input type="email" class="block mx-auto mb-[20px] w-[80%] rounded-lg bg-gray-100 border-gray-300" placeholder="Email">
                        <input type="tel" class="block mx-auto mb-[20px] w-[80%] rounded-lg bg-gray-100 border-gray-300" placeholder="Phone Number">
                    </div>
                    <button class="block mx-auto bg-orange-500 px-[30px] py-[5px] rounded-[12px] text-white">Sign Up</button>
                </div>
            </form>
        </div>
</template>

<style scoped lang="scss">
.card-design {
    background: radial-gradient(circle at -35% 140%, white 64%, #F9ECDB 65%, #F7B977 70%);
    @apply shadow-lg;
}

#inset-shadow{
    box-shadow: inset 0 0 4px rgba(0, 0, 0, 0.94);
}

.main-card-container {
    h1 {
        @apply text-orange-400;
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

form{
    //transform: scale(1.2);
}
</style>

