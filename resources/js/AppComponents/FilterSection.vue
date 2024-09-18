<script setup>
import {openSideBar} from "@/HelperFunctions/modalControl.js";


const icons = [
    {
        link:"https://img.icons8.com/ios/100/ffffff/filter--v1.png"
    },
    {
        link:"https://img.icons8.com/pastel-glyph/64/ffffff/download--v1.png"
    }
]
</script>


<template>
  <ul class="filter-panel gap-5">
    <li @click="openSideBar">
      <div class="w-[30px] h-[40px] pt-[5px]">
        <img width="29" height="29" :src="icons[0].link" alt="filter--v1"/>
      </div>
      <p>Filter</p>
    </li>
    <li>
      <div class="w-[40px] h-[40px] ">
        <img width="37" height="32" :src="icons[1].link" alt="download--v1"/>
      </div>
      <p>Export</p>
    </li>
  </ul>
</template>
<style lang="scss" scoped>
.filter-panel{
    @apply flex items-center;

    li{
        @apply flex items-center gap-2 hover:bg-gray-500 px-[10px] rounded  cursor-pointer;

        p{
            @apply text-sm text-white;
        }
    }

}

</style>
