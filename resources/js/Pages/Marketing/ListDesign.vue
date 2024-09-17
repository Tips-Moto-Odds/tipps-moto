<script setup>

</script>

<template>
    <div class="w-[100vw] h-[100vh] banner_background">
        <ul class="w-[400px] h-[40px]  mx-auto flex justify-between text-white mb-[20px]">
            <li class="h-[100%] w-[30%]  flex items-center justify-between">
                <div class="w-[30px] h-[30px] mr-[20px] ">
                    <img width="48" height="48" src="https://img.icons8.com/color/48/instagram-new--v1.png"
                         alt="instagram-new--v1"/>
                </div>
                <p>@tipsmoto_</p>
            </li>
            <li class="h-[100%] w-[30%]  flex items-center justify-between">
                <div class="w-[30px] h-[30px] mr-[20px] ">
                    <img width="48" height="48" src="https://img.icons8.com/color/48/facebook-new.png"
                         alt="facebook-new"/>
                </div>
                <p>@tipsmoto_</p>
            </li>
            <li class="h-[100%] w-[30%]  flex items-center justify-between">
                <div class="w-[30px] h-[30px] mr-[20px] ">
                    <img width="48" height="48" src="https://img.icons8.com/color/48/twitterx--v1.png"
                         alt="twitterx--v1"/>
                </div>
                <p>@tipsmoto_</p>
            </li>
        </ul>
        <div class="mx-auto w-[100px]">
            <img src="/storage/System/Icons/logo-dark.png" alt="">
        </div>
        <div class="mx-auto w-[300px] h-[60px] trap">
            <div class="w-full h-full">

            </div>
            <section class="text-white top-[0px] " style="position:relative; top: -40px">
                <h1 style="font-size: 25px" class="p-[0px] m-[0px] h-full text-center font-bold">PREMIER LEAGUE</h1>
            </section>
        </div>
        <div class="board pt-[10px]">
            <h1 style="font-size: 20px; text-shadow: 1px 1px 2px black; " class="p-[0px] mb-[20px] m-[0px]  text-center font-bold text-white">THIS WEEKEND MOTO MOTO GAMES</h1>
            <div class="heading-div">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ol style="list-style:numeric" class="w-[500px] text-white text-[20px] p-[20px] mx-auto">
                <li v-for="item in 5">MANCHESTER UNITED VS CHELSEA - AWAY WIN</li>
            </ol>
            <div>
                <p class="w-[500px] text-white text-[20px] p-[20px] mx-auto">MOTO MOTO LEVEL: 96% WIN RATE</p>
            </div>

        </div>
    </div>
</template>

<style scoped lang="scss">

.banner_background {
    background-image: url(/storage/System/field_background.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.trap {
    div {
        transform: perspective(100px) rotateX(30deg);
        background-image: linear-gradient(180deg, rgba(93,3,8,1) 0%, rgba(212,57,68,1) 100%);
        box-shadow: 0px 0px 10px 1px #e23434;
    }
}
.board{
    height: 500px;
    width: 600px;
    margin: auto;
    position:relative;
    top: -2px;
    background-image: linear-gradient(180deg, rgba(212,57,68,1) 0%, rgba(100, 2, 2, 0.3), rgba(26, 1, 1, 0.8) 100%);
    box-shadow: 0px 0px 10px 1px #e23434;
    border-radius: 2px;

    .heading-div{
        height: 50px;
        overflow: hidden;
        position: relative;
        div:nth-of-type(1){
            width: 200px;
            height: 50px;
            background-image:linear-gradient(135deg, #ea5d5d,#ea5d5d,#ea5d5d, #1a0101 ) ;
            position: absolute;
            top: 0px;
            left: 20px;
            transform: skew(30deg);
            z-index: 100;
            box-shadow: 0 0 10px #2b2b2b;

        }
        div:nth-of-type(2){
            width: 200px;
            height: 50px;
            background-color: red;
            position: absolute;
            top: 0px;
            right: 20px;
            transform: skew(-30deg);
            background-image:linear-gradient(-135deg, #ea5d5d,#ea5d5d,#ea5d5d, #1a0101 ) ;
            box-shadow: 0 0 10px #2b2b2b;

            z-index: 100;
        }
        div:nth-of-type(3){
            width: 90%;
            height: 45px;
            margin: 0px auto;
            position: relative;
            top: 3px;
            box-shadow: inset 0 15px 20px #0c0c0c;
        }
    }
}

</style>
