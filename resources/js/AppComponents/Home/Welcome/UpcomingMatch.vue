<script setup>

const props = defineProps(['upcoming'])
</script>

<template>
  <div v-if="upcoming != null" class="container bg-gray-900 rounded text-white md:w-1/2">
    <h3 class="text-center pt-3 mb-5 md:mb-0">Up Coming</h3>
    <div class="flex justify-around items-center mb-5 md:mb-3 mx-auto">
      <div class="flex gap-3 h-[20px] items-center">
        <p class="text-lg">{{ upcoming.home_teams }}</p>
        <p class="text-sm">VS</p>
        <p class="text-lg">{{ upcoming.away_teams }}</p>
      </div>
    </div>
    <div class="text-sm text-[14px] text-center mb-3">
      <p>May 1st 2024</p>
      <p>12:00Pm</p>
    </div>
    <div class="flex justify-center mb-3">
      <a class="bg-orange-500 px-8 py-3 rounded" href="/public">GET TIP</a>
    </div>
  </div>
</template>
