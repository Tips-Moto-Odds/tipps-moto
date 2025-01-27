<script setup>
import HomeTipsDisplay from "@/AppComponents/HomeTipsDisplay.vue";

const props = defineProps(['tips'])
</script>

<template>
  <section class="px-[10px] bg-gray-700 mb-[20px] container rounded-2">
    <div class="content-holder container rounded py-[30px]">
      <h1 class="mb-[40px] text-white text-center">Today's Free tips</h1>
      <ul class="mb-[20px] mx-0 p-0">
        <HomeTipsDisplay v-if="tips && tips.length > 0" v-for="item in tips" :tip="item" :key="item.id"/>
        <p v-else class="text-white h2 text-center bg-gray-600 rounded py-[100px]">No Free Tips Available</p>
      </ul>
      <Link as="button" href="/tips" class="action-button mx-auto block text-white bg-gray-600 hover:bg-orange-500 rounded-sm">More Tips</Link>
    </div>
  </section>
</template>
