<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import PriceCard from "@/AppComponents/PriceCard.vue";

const props = defineProps(['packages'])
</script>

<template>
    <HomeLayout>
        <div
            class="h-[100px] mb-[40px] banner xl:max-w-[1200px] xl:mx-auto xl:mt-[10px] xl:rounded xl:overflow-hidden md:max-h-[400px]">
            <div class="w-full h-full flex items-center justify-center  px-[20px] md:flex-row ">
                <h1 class="text-white text-[30px]">Available Plans</h1>
            </div>
        </div>

        <div class="px-[20px]">
            <div class="app-panel container mt-[50px] !mb-[50px]">
                <div class="app-panel-heading">
                </div>
                <ul class="pt-[10px] md:flex flex-wrap gap-2 justify-evenly pb-[50px]">
                    <price-card v-for="subscription in packages" :subscription :display-subscription="true"/>
                </ul>
            </div>
        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">
.banner {
    background-image: url("/storage/app/public/System/banner.png");
    background-size: cover;
    background-position: center;

    div {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
    }
}
</style>
