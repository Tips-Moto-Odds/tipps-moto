<script setup>
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";
</script>

<template>
  <div class="container p-0 flex justify-between flex-col md:flex-row mb-[20px] gap-y-2 md:gap-x-2 rounded">
    <div class="grid place-items-start rounded overflow-hidden ratio-1x1 md:w-1/2">
      <img src="/storage/System/content/banners/banner1.png" class="md:h-full object-cover">
    </div>
    <div class="md:w-1/2">
      <div class="h-[50%] flex mb-[10px] gap-x-[10px]">
        <Link href="/tips" as="div" class="w-[50%] rounded overflow-hidden">
          <img class="h-100 object-fit-cover" src="/storage/System/content/banners/tips-banner.png">
        </Link>
        <Link href="/tips#jp" class="w-[50%] rounded overflow-hidden">
          <img class="h-100 object-fit-cover" src="/storage/System/content/banners/jp.png">
        </Link>
      </div>
      <Link href="/tips#jp" as="div" class="rounded overflow-hidden h-[calc(50%_-10px)]">
        <JackpotCarousel/>
      </Link>
    </div>
  </div>
</template>
