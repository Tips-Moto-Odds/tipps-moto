<script setup>
import HomeTipsDisplay from "@/AppComponents/HomeTipsDisplay.vue";
import {useDateFormat} from "@vueuse/shared";

const props = defineProps(['tips'])

</script>

<template>
    <div class="bg-black text-app_white container !w-[95%] rounded-2 p-4 mb-5">
        <h1 class="mb-[40px] text-center">Yesterday's Tips</h1>

        <ul v-if="tips && tips.length > 0" class="mb-[20px] flex justify-around mx-0 p-0 flex-wrap gap-[10px]">
            <HomeTipsDisplay v-for="item in tips" :tip="item" :key="item.id"/>
        </ul>

        <h4 v-else class="text-white text-center mb-5">No Tips Available</h4>

    </div>
</template>
