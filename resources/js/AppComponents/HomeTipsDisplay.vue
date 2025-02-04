<script setup>

import {useDateFormat} from "@vueuse/shared";
import {usePage} from "@inertiajs/vue3";

const props = defineProps(['tip'])
const page = usePage();
</script>


<template>
    <div class="text-white  p-[10px] bg-app_gray w-100 md:max-w-[334px] rounded mb-[10px]">
        <section>
            <div class="flex justify-between mb-[10px]">
                <p></p>
                <p>{{ useDateFormat(tip.match_start_time, 'ddd, DD MMM ') }}</p>
                <p></p>
            </div>
            <div class="flex justify-between items-center text-sm mb-[10px]">
                <p class="w-100 text-right">{{ tip.home_teams }}</p>
<!--                <p class="mx-[2px] w-[200px] text-center">{{ useDateFormat(tip.match_start_time, 'HH:MM') }}</p>-->
                <p class="mx-[2px] w-[200px] text-center">vs</p>
                <p class="w-100 text-left">{{ tip.away_teams }}</p>
            </div>
            <div class="flex justify-center w-100 md:w-1/3">
                <div v-if="page.props.auth.user == null" class="bg-primary_orange rounded">
                    <p class="rounded  text-center mb-[1px] text-white">
                        <Link href="/login" as="p" class="cursor-pointer px-3 rounded  text-center py-1 text-white">Log In</Link>
                    </p>
                </div>
                <div v-else class="bg-primary_orange rounded w-50">
                    <p class="px-[10px] !py-[6px]  rounded  text-center  py-1 px-3 text-white">{{ tip.predictions }}</p>
                </div>
            </div>
        </section>
    </div>
</template>
