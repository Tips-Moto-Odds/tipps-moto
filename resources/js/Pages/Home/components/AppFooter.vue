<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="bg-gray-900 mx-auto">
        <div class="container">
            <div class="p-[20px] text-center text-white md:flex md:justify-around md:py-[80px]">
                <div class="font-light mb-[40px]">
                    <h1 class="text-orange-400 font-bold">Tips</h1>
                    <ul>
                        <li>EPL</li>
                        <li>Bundesliga</li>
                        <li>LaLiga</li>
                        <li>Series A</li>
                    </ul>
                </div>
                <div class="mb-[40px]">
                    <h1 class="text-orange-400 font-bold">Company</h1>
                    <ul>
                        <Link :as="'li'" class="cursor-pointer" :href="route('about')" >About</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('contactUs')" >Contact US</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('TermsAndConditions')" >Terms and Conditions</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('PrivacyPolicy')" >Privacy Policy</Link>
                    </ul>
                </div>
                <div class="mb-[40px]">
                    <h1 class="text-orange-400 font-bold">We are Social</h1>
                    <ul class="flex justify-center gap-2.5">
                        <li>Twi</li>
                        <li>Inst</li>
                        <li>Fb</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-500  pt-[5px]">
            <p class="text-center text-white text-sm ">Copyright 2024</p>
        </div>
    </div>
</template>

