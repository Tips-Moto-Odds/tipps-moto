<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="container flex flex-col md:flex-row text-white flex gap-2">
        <div class=" w-full bg-black p-[20px]">
            <h1 class="mb-[10px]">Tips</h1>
            <hr class="border border-white bg-white"/>
            <div class="flex flex-col md:flex-row md:flex-wrap gap-[10px] mb-[20px] justify-between items-center">
                <ul v-for="(item,index) in 17" class="p-0 m-0 overflow-hidden rounded max-w-[300px]">
                    <li class="w-[300px] bg-gray-500">
                        <div class="flex justify-between items-center">
                            <p class="m-0 p-[10px] w-[100px]">{{index+1}}</p>
                            <h6 class="text-center py-[10px]">Mon, 9 Jan</h6>
                            <div class="w-[100px]"></div>
                        </div>
                        <div class="flex  items-center text-sm justify-between px-[10px] py-[15px]">
                            <p>Manchester United</p>
                            <p>vs</p>
                            <p>Manchester Uniteds</p>
                        </div>
                        <div class="flex justify-between px-[10px] py-[8px]">
                            <p class="bg-orange-600 mx-auto px-[20px] py-[8px] rounded-sm inline-block ">Home Win</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>

.container {
    div {
        @apply rounded-lg;
    }
}

</style>
