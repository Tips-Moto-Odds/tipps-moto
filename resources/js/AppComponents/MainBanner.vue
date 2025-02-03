<script setup>
import JackpotCarousel from "@/AppComponents/JackpotCarousel.vue";
</script>

<template>
  <div class="banner container p-0  flex justify-between flex-col md:flex-row mb-[20px] mx-auto rounded">
    <div class="grid  place-items-center rounded overflow-hidden ratio-1x1 md:w-1/2 mx-auto md:mr-[10px] w-[95%] mb-[10px] md:mb-0">
      <img src="/storage/System/content/banners/banner1.png" class="md:h-full object-cover">
    </div>
    <div class="w-[100%] md:w-1/2 px-[10px]">
      <div class="h-[50%] flex mb-[10px] gap-x-[10px]">
        <Link href="/tips#ftp" as="div" class="w-[50%] rounded overflow-hidden">
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
