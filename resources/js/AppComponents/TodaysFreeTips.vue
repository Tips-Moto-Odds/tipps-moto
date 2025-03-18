<script setup>
import HomeTipsDisplay from "@/AppComponents/HomeTipsDisplay.vue";
import {useDateFormat} from "@vueuse/shared";
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps(['tips', 'canViewFreeTips'])
const page = usePage()

const shouldDisplayTips = computed(() => {
    if (page.props.auth.user == null) {
        return true;
    } else {
        return props.canViewFreeTips
    }
})
</script>

<template>
    <div class="container bg-black text-app_white rounded-2 p-4 mb-4">
        <h1 class="mb-[40px] text-center">Today's Free Tips</h1>

        <h4 v-if="tips.length === 0" class="text-white text-center mb-5">No Free Tips Available</h4>

        <ul v-else-if="tips && tips.length > 0 && canViewFreeTips" class="mb-[20px] flex justify-around mx-0 p-0 flex-wrap gap-[10px]">
            <HomeTipsDisplay v-for="item in tips" :tip="item" :key="item.id"/>
        </ul>

        <h4 v-else class="text-white text-center mb-5">Please purchase at least one package to continue enjoying free tips</h4>


        <Link as="button" href="/tips" class="p-1 px-3 rounded mx-auto block bg-primary_orange ">More Tips</Link>
    </div>
</template>
