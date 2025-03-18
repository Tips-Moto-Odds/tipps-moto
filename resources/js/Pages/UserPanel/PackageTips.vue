<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import HomeTipsDisplay from "@/AppComponents/HomeTipsDisplay.vue";

const props = defineProps(['tips'])
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="container bg-black  rounded text-white">
        <div class="mb-4 border-bottom pt-3 rounded-0 w-full">
            <h3 class="m-0">Tips</h3>
        </div>
        <div v-if="tips.length > 0" class="rounded flex justify-around md:gap-y-3 flex-wrap">
            <HomeTipsDisplay v-for="item in tips" :tip="item" :key="item.id"/>
        </div>
        <p v-else class="text-sm text-center p-[10px] bg-gray-900">No active Tips Available Today. Please try again later</p>
    </div>
</template>

<style lang="scss" scoped>

.container {
    div {
        @apply rounded-lg;
    }
}

</style>
