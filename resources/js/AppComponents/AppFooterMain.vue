<template>
  <div class="w-full">
    <div class="footer container flex justify-between rounded mb-[20px] bg-[#D88731] p-[20px]">
      <section class="flex gap-[20px]">
        <div>
          <h5 class="h5 font-bold">Links</h5>
          <ul>
            <li>Tips</li>
            <li>Jackpots</li>
            <li>Dashboard</li>
            <li>About Us</li>
            <li>Contact</li>
          </ul>
        </div>
        <div>
          <h5 class="h5 font-bold">Resources</h5>
          <ul>
            <li>Blog</li>
            <li>FAQs</li>
            <li>PrivacyPolicy</li>
            <li>Help Center</li>
            <li>Site Map</li>
          </ul>
        </div>
      </section>
      <section class="h-[100%]">
        <div class=" flex justify-end mb-[20px] w-full">
          <img class="w-[100px]" src="storage/System/Icons/logo-dark.png">
        </div>
        <ul class="flex gap-[20px]">
          <li v-for="item in 4" class="bg-white w-[50px] h-[50px]"></li>
        </ul>
      </section>
    </div>
    <div class="container flex justify-center p-[20px]">
      <p class="text-white">Copyright © 2024-2025 Tips Moto. All rights reserved.</p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'app-footer-main'
}
</script>
<style lang="scss" scoped>

.footer {
  section:first-of-type {
    div {
      @apply p-[10px] w-[200px];

      li {
        @apply text-black;
      }
    }
  }
}

</style>