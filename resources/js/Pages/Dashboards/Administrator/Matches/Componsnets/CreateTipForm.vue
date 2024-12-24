<script setup>
defineProps(['tipForm'])
</script>
<template>
    <div class="mx-auto pt-[10px] text-center text-[20px] items-center rounded mb-[40px]">
        <div class="mb-[10px]">
            <label>League</label>
            <input v-model="tipForm.predictions" class=" text-sm w-full rounded self-end text-black">
        </div>
        <div class="flex mb-[10px] flex-wrap w-full justify-between">
            <div class="w-1/2 flex flex-col">
                <label>Home Team</label>
                <input v-model="tipForm.home_teams" class="w-[95%] text-sm  rounded text-black">
            </div>
            <div class="w-1/2 flex flex-col">
                <label>Away Team</label>
                <input v-model="tipForm.away_teams" class="w-[95%] text-sm  rounded self-end text-black">
            </div>
        </div>
        <div class="mb-[10px]">
            <label>Match Time</label>
            <input v-model="tipForm.match_start_time" class="w-full rounded text-black" type="datetime-local">
        </div>
    </div>
</template>
