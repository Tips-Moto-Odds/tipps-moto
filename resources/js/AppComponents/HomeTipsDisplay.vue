<script setup>

import {useDateFormat} from "@vueuse/shared";
import {usePage} from "@inertiajs/vue3";
import TipButtonDisplay from "@/AppComponents/TipButtonDisplay.vue";

const props = defineProps(['tip','tags'])
const page = usePage();

console.log(props.tags?.includes('yesterdays-tips'));
</script>


<template>
    <div class="text-white  p-[10px] bg-app_gray w-100 md:max-w-[334px] rounded mb-[10px]">
        <section>
            <div class="flex justify-between mb-[10px]">
                <p></p>
                <p>{{ useDateFormat(tip.match_start_time, 'DD-MM-YYYY') }}</p>
                <p></p>
            </div>
            <div class="flex justify-between items-center text-sm mb-[10px]">
                <p class="w-100 text-right">{{ tip.home_teams }}</p>
                <p class="mx-[2px] w-[200px] text-center">{{ useDateFormat(tip.match_start_time, 'HH:mm') }}</p>
                <p class="w-100 text-left">{{ tip.away_teams }}</p>
            </div>
            <div class="flex justify-center w-100 md:w-1/3">
                <template v-if="!tags?.includes('yesterdays-tips')">
                    <div  v-if="page.props.auth.user == null" class="bg-primary_orange rounded w-[108px]">
                        <Link href="/login" as="p" class="prediction-card-display">Log In</Link>
                    </div>
                    <TipButtonDisplay v-else :tip="tip"  :tags="tags"/>
                </template>
                <TipButtonDisplay v-else :tip="tip" :tags="tags"/>
            </div>
        </section>
    </div>
</template>

<style lang="scss" scoped>
.prediction-card-display {
    @apply rounded text-center py-1 text-white;
}

</style>
