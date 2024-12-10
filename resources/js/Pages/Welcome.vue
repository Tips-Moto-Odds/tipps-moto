<script setup>
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import TipDisplay from "@/AppComponents/Global/TipDisplay.vue";
import MatchHistory from "@/AppComponents/Home/Welcome/MatchHistory.vue";
import UpcomingMatch from "@/AppComponents/Home/Welcome/UpcomingMatch.vue";
import {site_summary} from "@/AppComponents/Home/Welcome/DataFile.js";
import {Head} from "@inertiajs/vue3";

const props = defineProps(['tips', 'upcoming'])
</script>

<template>
  <HomeLayout>
    <Head title="Home"/>

    <div class="banner">

      <div>
        <div>
          <img alt="logo" class="w-[100px] mb-[20px] md:hidden mx-auto" src="/storage/System/Icons/logo-dark.png">
          <h2 class="text-white text-5 mb-7 font-semibold text-center md:text-lg md:px-5 md:text-left">Home of Premium League <br> betting tips</h2>
          <p class="text-white px-2 mb-3 text-center text-3 md:text-4 md:px-5 md:text-left">
            Get the latest winning tips from Tips moto and become an expert <br class="hidden md:block"> in sports betting</p>
        </div>
        <UpcomingMatch :upcoming></UpcomingMatch>
      </div>
    </div>

    <div class="container app-panel p-4 rounded">
      <div class="app-panel-heading flex justify-center"><h1>TIPS MOTO BETTING TIPS</h1></div>
      <div class="content-area p-2 max-w-[900px] md:mx-auto text-white text-sm">
        <p class="mb-8 text-center ">{{ site_summary }}</p>
      </div>
    </div>

    <div v-if="tips != null && tips.length > 0" class="container app-panel p-[10px] rounded mb-5 text-white">
      <div class="app-panel-heading">
        <h1 class="text-center">TODAY'S FREE TIPS</h1>
      </div>

      <ul class="mx-auto max-w-[800px] mb-8">
        <li v-for="tip in tips">
          <tip-display :item="tip"></tip-display>
        </li>
      </ul>
      <div class="flex">
        <Link :href="route('packages')" class="inline-block mx-auto bg-orange-400 px-8 py-1 rounded-sm mb-12">GET MORE</Link>
      </div>
    </div>

    <template v-show="false">
      <div v-if="tips != null && tips.length > 0" class="container app-panel p-3 rounded mb-5">
        <div class="app-panel-heading flex justify-center"><h1>PREVIOUS MATCHES</h1></div>
        <MatchHistory :tips/>
      </div>
    </template>

  </HomeLayout>
</template>

<style lang="scss" scoped>
.banner {
  background-image: url("/storage/app/public/System/banner.png");
  @apply h-[calc(100vh_-_80px)] mb-10 bg-cover bg-center
  md:max-h-[400px]
  xl:max-w-[1200px] xl:mx-auto xl:mt-3 xl:rounded xl:overflow-hidden;

  & > div {
    background-color: rgba(0, 0, 0, 0.7);
    @apply h-full p-5 grid place-items-center md:flex;
  }
}

</style>
