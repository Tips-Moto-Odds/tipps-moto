<script setup>

import {useDateFormat} from "@vueuse/shared";

const props = defineProps(['tip'])
</script>


<template>
  <li class=" text-white  p-[10px] bg-gray-600 hover:bg-gray-700 cursor-pointer  rounded mb-[10px]">
    <section>
      <div>
        <p class="h5 p-0 m-0">League: {{tip.league}}</p>
      </div>
      <div class="flex justify-between items-center">
        <div class="flex-column flex justify-center items-center">
          <p>{{tip.home_teams}}</p>
          <p>{{tip.away_teams}}</p>
        </div>
        <div class=" flex-column flex items-center">
          <p>{{useDateFormat(tip.match_start_time,'MMM, DD/YYYY')}}</p>
          <p>{{useDateFormat(tip.match_start_time,'hh:mm a')}}</p>
        </div>
        <div class=" flex-column flex bg-green-500 rounded">
          <p class="px-[10px] !py-[6px]  rounded  text-center mb-[1px] py-1 text-white">{{tip.prediction_type}}</p>
          <p class="px-[10px] !py-[6px]  rounded  text-center  py-1 px-[10px] text-white">{{tip.predictions}}</p>
        </div>
      </div>
    </section>
  </li>
</template>
