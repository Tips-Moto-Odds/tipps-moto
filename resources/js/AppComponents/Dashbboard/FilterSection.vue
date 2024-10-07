<script setup>
import {openSideBar} from "@/HelperFunctions/modalControl.js";


const icons = [
  {
    link: "https://img.icons8.com/ios/100/ffffff/filter--v1.png"
  },
  {
    link: "https://img.icons8.com/pastel-glyph/64/ffffff/download--v1.png"
  }
]
</script>


<template>
  <ul class="filter-panel gap-5">
    <li @click="openSideBar">
      <img width="24" height="24" :src="icons[0].link" alt="filter--v1"/>
      <p>Filter</p>
    </li>
    <li>
      <img width="32" height="32" :src="icons[1].link" alt="download--v1"/>
      <p>Export</p>
    </li>
  </ul>
</template>
<style lang="scss" scoped>
.filter-panel {
  @apply flex items-center justify-center;

  li {
    @apply hover:bg-gray-500 h-[40px] w-[90px] rounded cursor-pointer flex items-center justify-center;

    p {
      @apply text-sm text-white;
    }
  }

}

</style>
