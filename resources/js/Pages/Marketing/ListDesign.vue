<script setup>
const props = defineProps(['events','league'])
</script>

<template>
    <div class="pt-[20px] h-[100vh] banner_background">
        <ul class="mx-auto w-full md:w-[500px] flex justify-around text-white mb-[20px] gap-x-2">
            <li class="h-[100%] flex items-center justify-center">
                <img width="30" height="40" src="https://img.icons8.com/color/48/instagram-new--v1.png"/>
                <p class="text-[15px]">@tipsmoto_</p>
            </li>
            <li class="h-[100%] flex items-center justify-center">
                <img width="30" height="40" src="https://img.icons8.com/color/48/facebook-new.png"/>
                <p class="text-[15px]">@tipsmoto_</p>
            </li>
            <li class="h-[100%] flex items-center justify-center">
                <img width="30" height="40" src="https://img.icons8.com/color/48/twitterx--v1.png"/>
                <p class="text-[15px]">@tipsmoto_</p>
            </li>
        </ul>
        <div class="mx-auto w-[80px] mb-[10px]">
            <img src="/storage/System/Icons/logo-dark.png" alt="">
        </div>
        <div class="mx-auto w-[150px] h-[40px] trap">
            <div class="w-full h-full"></div>
            <section class="text-white w-full relative px-[10px]" style="top: -30px">
                <h1 class="text-center w-full text-[14px] font-bold">{{league}}</h1>
            </section>
        </div>
        <div class="px-[20px] ">
            <div class="board pt-[10px] mx-auto max-w-[400px] px-[20px]">
                <h1 style="text-shadow: 1px 1px 2px black;"
                    class="p-[0px] text-[18px] mb-[20px] m-[0px]  text-center text-white">MOTO MOTO GAMES</h1>
                <ul class="text-white text-[14px] p-[1px] mx-auto mb-[10px]">
                    <li v-for="item in events"
                        class="px-[10px] bg-green-500 mb-[5px] rounded-xl flex items-start justify-between w-fit mx-auto ">
                        <div class="flex items-center gap-x-2">
                            <div class="w-[50px] p-[5px] overflow-hidden h-[50px] rounded bg-white mt-[5px] ">
                                <img width="50px" height="50px" :src="item.home" alt="manchester-united-fc"/>
                            </div>
                            <p class="text-[20px]">{{ item.home_score }}</p>
                        </div>
                        <div class="flex w-full flex-col px-[10px] pt-[20px]">
                            <p class="text-center mb-[10px]">-</p>
                            <p v-if="item.prediction && item.prediction == 1" class="mx-[20px] text-center">Home Win</p>
                            <p v-else-if="item.prediction && item.prediction == 2" class="mx-[20px] text-center">Away
                                Win</p>
                            <p v-if="item.prediction && item.prediction == 'X'" class="mx-[20px] text-center">Draw</p>
                        </div>
                        <div class="flex items-center gap-x-2">
                            <p class="text-[20px]">{{ item.away_score }}</p>
                            <div class="w-[50px] p-[5px] h-[50px] rounded mt-[5px] bg-white ">
                                <img width="50px" height="50px" :src="item.away" alt="chelsea-fc"/>
                            </div>
                        </div>
                    </li>
                </ul>
                <div>
                    <p class=" text-white text-[18px] p-[5px] mx-auto text-center">MOTO MOTO LEVEL: 100% WIN RATE</p>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">

.banner_background {
    width: 500px;
    margin: 0px auto;
    margin-top: 20px;
    height: 800px;
    overflow: hidden;
    background-image: url(/storage/System/field_background.jpg);
    background-size: cover;
    background-repeat: no-repeat;
}

.trap {
    div {
        margin: 0 auto;
        transform: perspective(60px) rotateX(30deg);
        background-image: linear-gradient(180deg, rgba(93, 3, 8, 1) 0%, rgba(212, 57, 68, 1) 100%);
        box-shadow: 0px 0px 10px 1px #e23434;
    }
}

.board {
    position: relative;
    padding: 10px;
    top: -2px;
    background-image: linear-gradient(180deg, rgba(212, 57, 68, 1) 0%, rgba(100, 2, 2, 0.3), rgba(26, 1, 1, 0.8) 100%);
    box-shadow: 0px 0px 10px 1px #e23434;
    border-radius: 2px;

    .heading-div {
        height: 50px;
        overflow: hidden;
        position: relative;

        div:nth-of-type(1) {
            background-image: linear-gradient(135deg, #ea5d5d, #ea5d5d, #ea5d5d, #1a0101);
            position: absolute;
            top: 0;
            left: 20px;
            transform: skew(30deg);
            z-index: 100;
            box-shadow: 0 0 10px #2b2b2b;
        }

        div:nth-of-type(2) {
            background-color: red;
            position: absolute;
            top: 0;
            right: 20px;
            transform: skew(-30deg);
            background-image: linear-gradient(-135deg, #ea5d5d, #ea5d5d, #ea5d5d, #1a0101);
            box-shadow: 0 0 10px #2b2b2b;
            z-index: 100;
        }

        div:nth-of-type(3) {
            position: relative;
            top: 3px;
            box-shadow: inset 0 15px 20px #0c0c0c;
        }
    }
}

</style>
