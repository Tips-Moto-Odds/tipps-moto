<script setup>
import {useDateFormat} from "@vueuse/shared";

defineProps(['match'])
</script>
<template>
    <div id="banner" class="mx-auto text-center text-[20px]  items-center rounded mb-[40px] rounded-lg overflow-hidden">
        <div class="bg-black/50 w-[100%] h-[100%] p-[20px]">
            <div class="w-100 h-[20px] flex justify-end">
                <Link :href="route('dashboard.matches.updateMatch',[match.id])" as="div" class="w-[30px] h-[30px] p-[3px] flex items-center justify-center rounded border-[2px] border-gray-400 hove:text-gray-200 hover:border-gray-200">
                    <i class="bi bi-pen-fill text-[20px]" title="Edit Match"></i>
                </Link>
            </div>
            <h2 class="mb-[60px] ">{{ match.league }}</h2>
            <div class="match-card-body mb-[40px]">
                <div>
                    <div class="flex items-center justify-center">
                        <img width="80" height="80" src="https://img.icons8.com/ios-filled/100/B4B4B4/football2--v1.png" alt="football2--v1"/>
                    </div>
                    <h3>{{ match.home_teams }}</h3>
                </div>
                <div>
                    <div class="flex items-center justify-center">
                        <img width="80" height="80" src="https://img.icons8.com/ios-filled/100/B4B4B4/football2--v1.png" alt="football2--v1"/>
                    </div>
                    <h3>{{ match.away_teams }}</h3>
                </div>
            </div>
            <p class="text-center  p-0 mb-[10px]">{{ useDateFormat(match.match_start_time, 'hh:mm a').value }}</p>
            <p class="text-center ">{{ useDateFormat(match.match_start_time, 'MMMM DD YYYY').value }}</p>
        </div>
    </div>
</template>
<style lang="scss" scoped>
#banner {
    background-image: url("/storage/System/field_background.jpg");
    background-size: cover;
}

.match-card-body {
    @apply mx-auto flex w-fit justify-center items-center gap-[150px];
    & > div {
        @apply flex flex-col justify-center items-center;
        div {
            @apply w-[100px] h-[100px] bg-gray-600 rounded-lg mb-3;
        }
    }
}

</style>
