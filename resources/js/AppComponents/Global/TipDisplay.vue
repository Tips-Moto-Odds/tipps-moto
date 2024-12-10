<script setup>

import {formatAMPM, formatDate} from "../../HelperFunctions/dateReformat.js";


const props = defineProps(['item'])
const emit = defineEmits(['purchaseTip'])

</script>

<template>
  <li class="bg-gray-800 mb-[10px] flex justify-between p-[10px] rounded">
    <div class="text-sm w-1/3">
      <p>{{ item.home_teams }}</p>
      <p>{{ item.home_teams }}</p>
    </div>
    <div class="text-sm w-1/3">
      <p class="text-center">{{ formatDate(item.match_start_time) }}</p>
      <p class="text-center">{{ formatAMPM(item.match_start_time) }}</p>
    </div>
    <div class="text-sm w-1/3 flex justify-end items-center">
      <div class="bg-gray-600 w-fit p-1 rounded-sm">Home Win</div>
    </div>
  </li>
</template>

<style lang="scss" scoped>
.container {
  & > div {
  }
}

.chart-display {
  @apply text-sm;

  section {
    @apply flex my-[10px] px-[20px];

    ul {
      @apply flex justify-around mb-[10px] gap-2.5;

      li {
        @apply text-center bg-red-400 h-[20px] w-[20px] rounded-[50%] flex items-center justify-center text-[10px];
      }
    }
  }
}
</style>
