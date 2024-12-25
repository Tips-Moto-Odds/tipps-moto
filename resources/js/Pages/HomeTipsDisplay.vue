<script setup>

import {useDateFormat} from "@vueuse/shared";

const props = defineProps(['tip'])
</script>


<template>
  <li class="text-white  p-[10px] bg-gray-600 hover:bg-gray-700 cursor-pointer  rounded mb-[10px]">
    <section>
      <div class="mb-[20px]">
        <p class="h5 p-0 m-0">League: {{ tip.league }}</p>
      </div>
      <div class=" flex flex-col md:flex-row justify-between items-center text-sm">
        <div class="md:hidden flex justify-around gap-2 w-100 md:w-1/3   md:block">
          <p class="p-[10px] w-100 bg-gray-700 rounded mb-[10px] text-center ">{{ tip.home_teams }}</p>
          <p class="p-[10px] w-100 bg-gray-700 rounded mb-[10px] text-center ">{{ tip.away_teams }}</p>
        </div>
        <div class="hidden justify-around gap-2 w-100 md:w-1/3 md:block">
          <p class="p-[10px] w-100 bg-gray-700 rounded mb-[10px] text-left  ">{{ tip.home_teams }}</p>
          <p class="p-[10px] w-100 bg-gray-700 rounded mb-[10px] text-left  ">{{ tip.away_teams }}</p>
        </div>
        <div class=" flex-column flex items-center mb-[20px] md:m-0 w-100 md:w-1/3">
          <p>{{ useDateFormat(tip.match_start_time, 'MMM, DD/YYYY') }}</p>
          <p>{{ useDateFormat(tip.match_start_time, 'hh:mm a') }}</p>
        </div>
        <div class="flex justify-center w-100 md:w-1/3">
          <div class="bg-green-500 rounded w-50">
            <p class="px-[10px] !py-[6px]  rounded  text-center mb-[1px] py-1 text-white">{{ tip.prediction_type }}</p>
            <p class="px-[10px] !py-[6px]  rounded  text-center  py-1 px-[10px] text-white">{{ tip.predictions }}</p>
          </div>
        </div>
      </div>
    </section>
  </li>
</template>
