<script setup>
import {Head} from '@inertiajs/inertia-vue3'
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";
import HomeTipsDisplay from "@/Pages/HomeTipsDisplay.vue";

const props = defineProps(['tips'])
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="banner container flex justify-between flex-col md:flex-row mb-[20px] gap-2 mx-auto rounded">
        <div class="grid  place-items-center rounded overflow-hidden ratio-1x1 md:w-1/2">
            <img src="/storage/System/content/banners/banner1.png" class="md:h-full object-fit-cover">
        </div>
        <div class="w-[100%] md:w-1/2 ">
            <div class="h-[50%] flex mb-[10px] gap-x-[10px]">
                <Link href="/tips#ftp" as="div" class="w-[50%] rounded overflow-hidden">
                    <img class="" src="/storage/System/content/banners/tips-banner.png">
                </Link>
                <Link href="/tips#jp" class="w-[50%] rounded overflow-hidden">
                    <img class="" src="/storage/System/content/banners/jp.png">
                </Link>
            </div>
            <Link href="/tips#jp" as="div" class="rounded overflow-hidden h-[calc(50%_-10px)]">
                <JackpotCarousel/>
            </Link>
        </div>
    </div>

    <section class="px-[10px]">
        <div class="content-holder container rounded py-[30px]">
            <h1 class="mb-[40px] text-white text-center">Today's Free tips</h1>
            <ul class="mb-[20px] mx-0 p-0">
                <HomeTipsDisplay v-if="tips && tips.length > 0" v-for="item in tips" :tip="item" :key="item.id"/>
                <p v-else class="text-white h2 text-center bg-gray-600 rounded py-[100px]">No Free Tips Available</p>
            </ul>
            <Link as="button" href="/tips" class="action-button mx-auto block text-white bg-gray-600 hover:bg-orange-500 rounded-sm">More Tips</Link>
        </div>
    </section>
    <app-footer-main/>
</template>

<style lang="scss" scoped>
.banner {
    h1 {
        @apply text-white
    }
}

.content-holder {
    @apply mb-[20px] bg-gray-800   mx-auto;

    h1 {
        @apply mb-[40px] text-white;
    }

    ul {
        @apply mb-[20px] w-full
    }
}
</style>
