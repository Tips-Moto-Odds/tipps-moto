<script setup>
const prop = defineProps(['tips'])
</script>

<template>
  <div>
    <div class="h-[50px] flex items-center justify-center gap-2 px-[20px] mb-[30px]">
      <div class="w-[25px] h-[25px] rounded-[50%] flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
             class="bi bi-caret-left-fill" viewBox="0 0 16 16">
          <path
              d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
        </svg>
      </div>
      <div class="h-[40px] flex items-center justify-center text-white px-[20px]">
        <p>15 August 2023</p>
      </div>
      <div class="w-[25px] h-[25px]  rounded-[50%] flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
             class="bi bi-caret-right-fill" viewBox="0 0 16 16">
          <path
              d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
        </svg>
      </div>
    </div>
    <table class="bg-gray-400 overflow-hidden rounded">
      <thead class="bg-gray-800">
      <tr>
          <th class="px-[5px]">Match</th>
          <th>Date & Time</th>
          <th>Tip</th>
          <th>Result</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="match in tips" class="hover:!bg-gray-600">
        <td>{{ match.home_teams }}  -  {{ match.away_teams }}</td>
        <td>{{ match.match_start_time }}</td>
        <td>{{ match.predictions }}</td>
        <td>{{ match.winning_status }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<style lang="scss" scoped>
tr:nth-of-type(even) {
    border: none;
    @apply bg-gray-500;
}

td{
    @apply py-[10px];
}
</style>
