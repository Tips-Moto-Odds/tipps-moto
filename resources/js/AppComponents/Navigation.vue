<script setup>
import {usePage} from "@inertiajs/vue3";
const page = usePage()
</script>
<template>
  <div class="w-[99%] shadow flex justify-content-between align-items-sm-center mb-[20px] px-[20px] mx-auto rounded mt-[20px] bg-[#D88731] h-[67px]">
    <div class="text-white px-[10px] py-[3px] rounded">
        <img class="w-[60px]" src="storage/System/Icons/logo-dark.png">
    </div>
    <ul class=" flex gap-xl-2 m-0">
      <Link class="menu-button" :class="{'active':page.url == '/'}" href="/" as="li">Home</Link>
      <Link class="menu-button" :class="{'active':page.url == '/tips'}" href="/tips" as="li">Tips</Link>
      <Link class="menu-button" href="/contact" as="li">Contact</Link>
      <Link class=" text-black align-items-sm-center  px-[10px] rounded" href="/public" as="li">
        <i class="bi bi-person-circle text-[30px]"></i>
      </Link>
    </ul>
  </div>
</template>
<style lang="scss" scoped>
.menu-button{
    @apply bg-[#353538] text-white self-center text-[16px]  px-[8px] rounded;
}

.menu-button.active{
    @apply bg-[#000];
}
</style>
