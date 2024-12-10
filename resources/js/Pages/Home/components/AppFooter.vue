<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="bg-gray-900 mx-auto">
        <div class="container">
            <div class="p-[20px] text-center text-white md:flex md:justify-around md:py-[80px]">
                <div class="mb-[40px]">
                    <h1 class="text-orange-400 font-bold">Company</h1>
                    <ul>
                        <Link :as="'li'" class="cursor-pointer" :href="route('about')" >About</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('contact')" >Contact us</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('termsAndConditions')" >Terms and Conditions</Link>
                        <Link :as="'li'" class="cursor-pointer" :href="route('privacyPolicy')" >Privacy Policy</Link>
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

