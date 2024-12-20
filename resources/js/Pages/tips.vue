<script setup>
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import {applyBackGroundOrange} from "@/HelperFunctions/appFunctions.js";

applyBackGroundOrange()

</script>

<template>
    <Navigation/>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-black rounded">
        <h1 class="text-center py-[20px]">Full-Time Scores</h1>
        <p class="px-[30px] mb-[30px] text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut imperdiet tortor. Sed fermentum
            posuere luctus. In aliquam, purus non sollicitudin laoreet, sem nisi sagittis nisi, eu accumsan mauris eros at dui. Cras
            ullamcorper tellus eu cursus tristique. Morbi molestie porttitor orci, sit amet congue leo porta quis. Ut pulvinar commodo
            justo, sed consectetur risus porta sed. Mauris convallis elementum lacinia. Nam interdum ut nulla sit amet pharetra. Donec ac
            eleifend augue. Nullam et nisl sed odio facilisis pharetra. Phasellus vitae quam urna. Suspendisse potenti. Vivamus in odio
            dui.</p>
        <div class="mb-[20px] flex items-center justify-center gap-x-[100px] py-[20px]">
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded">
                <h3 class="text-center px-[20px]">KES 99/- per day for 15 games.</h3>
            </div>
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded">
                <h3 class="text-center px-[20px]">KES 599/- per week for 17 games daily.</h3>
            </div>
        </div>
    </div>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-black rounded">
        <h1 class="text-center py-[20px]">Over & Under Markets</h1>
        <p class="px-[30px] mb-[30px] text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut imperdiet tortor. Sed fermentum
            posuere luctus. In aliquam, purus non sollicitudin laoreet, sem nisi sagittis nisi, eu accumsan mauris eros at dui. Cras
            ullamcorper tellus eu cursus tristique. Morbi molestie porttitor orci, sit amet congue leo porta quis. Ut pulvinar commodo
            justo, sed consectetur risus porta sed. Mauris convallis elementum lacinia. Nam interdum ut nulla sit amet pharetra. Donec ac
            eleifend augue. Nullam et nisl sed odio facilisis pharetra. Phasellus vitae quam urna. Suspendisse potenti. Vivamus in odio
            dui.</p>
        <div class="mb-[20px] flex items-center justify-center gap-x-[100px] py-[20px]">
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded">
                <h3 class="text-center px-[20px]">KES 29/- daily for 5 games</h3>
            </div>
            <div class="flex justify-center items-center h-[300px] bg-gray-400 w-[300px] rounded">
                <h3 class="text-center px-[20px]">KES 199/- weekly for 7 games daily</h3>
            </div>
        </div>
    </div>
    <div class="container main-card-container mb-[20px] mx-auto p-[10px] bg-black rounded">
        <h1 class="text-center py-[20px]">Jackpot Tips</h1>
        <p class="px-[30px] mb-[30px] text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut imperdiet tortor. Sed fermentum
            posuere luctus. In aliquam, purus non sollicitudin laoreet, sem nisi sagittis nisi, eu accumsan mauris eros at dui. Cras
            ullamcorper tellus eu cursus tristique. Morbi molestie porttitor orci, sit amet congue leo porta quis. Ut pulvinar commodo
            justo, sed consectetur risus porta sed. Mauris convallis elementum lacinia. Nam interdum ut nulla sit amet pharetra. Donec ac
            eleifend augue. Nullam et nisl sed odio facilisis pharetra. Phasellus vitae quam urna. Suspendisse potenti. Vivamus in odio
            dui.</p>
        <div class="container flex justify-content-between mb-[20px] mx-auto rounded">
            <div class="bg-gray-400 h-[410px] w-[500px] grid place-items-center rounded">
                <h6>Daily: Mozzart @ KES 39/- per jackpot</h6>
            </div>
            <div class="w-[calc(100%-510px)] h-[400px] ">
                <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">
                    <div class="w-[50%] h-[100%] rounded bg-gray-400 grid place-items-center">
                        <h6>Midweek: Sportpesa @ KES 49/- per jackpot.</h6>
                    </div>
                    <div class="w-[50%] h-[100%] rounded bg-gray-400 grid place-items-center">
                        <h6>Mega Jackpot: Sportpesa @ KES 49/-</h6>
                    </div>
                </div>
                <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">
                    <div class="w-[50%] h-[100%] rounded bg-gray-400 grid place-items-center">
                        <h6>Weekly:
                            <ul class="list-disc py-[10px]">
                                <li>Odibet @ KES 29/-.</li>
                                <li>Mozzart @ KES 29/-.</li>
                            </ul>
                        </h6>
                    </div>

                    <div class="w-[50%] h-[100%] rounded bg-gray-400 grid place-items-center">
                        <h6>Segmented Jackpots: 3 games @ KES 15/-</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <app-footer-main/>
</template>

<style scoped lang="scss">
.main-card-container{
    h1{
        @apply text-orange-400;
    }
    p{
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
</style>

