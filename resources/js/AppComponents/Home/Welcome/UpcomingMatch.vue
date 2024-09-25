<script setup>

const props = defineProps(['upcoming'])
</script>

<template>
    <div v-if="upcoming != null" class="container bg-gray-900 bg-red rounded text-white md:w-1/2">
        <h3 class="text-center pt-[10px] mb-[20px] md:text-2xl md:mb-[0px]">Up Coming</h3>
        <div
            class="flex justify-around items-center mb-[20px] md:mb-[10px] md:h-[200px] md:max-w-[450px] mx-auto">
            <div>
                <div class="w-[80px] h-[80px] p-[10px] rounded bg-white">
                    <img class="h-full w-full object-contain" v-if="upcoming"
                         :src="'/storage/System/TeamLogos/' + upcoming.home_logo" alt="image">
                </div>
            </div>
            <div>
                <p>VS</p>
            </div>
            <div>
                <div class="w-[80px] h-[80px] bg-white rounded">
                    <img class="h-full w-full object-contain" v-if="upcoming"
                         :src="'/storage/System/TeamLogos/' + upcoming.away_logo" alt="image">
                </div>
            </div>
        </div>
        <div class="text-white text-[14px] text-center mb-[10px]">
            <p>May 1st 2024</p>
            <p>12:00Pm</p>
        </div>
        <div class="flex justify-center mb-[10px]">
            <a class="bg-orange-500 px-[30px] py-[10px] rounded" href="/public">GET TIP</a>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
