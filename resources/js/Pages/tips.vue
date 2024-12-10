<script setup>
import Navigation from "@/AppComponents/Navigation.vue";
</script>

<template>
    <Navigation/>
    <div class="container flex justify-content-between mb-[20px] mx-auto rounded">
        <div class="bg-gray-400 h-[410px] w-[500px] rounded">

        </div>
        <div class="w-[calc(100%-510px)] h-[400px] ">
            <div class="h-[50%]  mb-[10px] flex gap-x-[10px]">
                <div class="w-[50%] h-[100%] rounded bg-gray-400"></div>
                <div class="w-[50%] h-[100%] rounded bg-gray-400"></div>
            </div>
            <div class="w-[100%] h-[50%] rounded bg-gray-400"></div>
        </div>
    </div>

    <div class="container flex justify-center items-center mb-[20px] mx-auto bg-gray-300 rounded h-[500px]">
        <h1>Free tips section</h1>
    </div>
    <div class="container flex justify-center items-center mb-[20px] mx-auto bg-gray-300 rounded h-[500px]">
        <h1>Previous tips</h1>
    </div>
    <div class="flex justify-center items-center bg-gray-300 h-[300px]">
        <h1>Footer</h1>
    </div>
</template>

