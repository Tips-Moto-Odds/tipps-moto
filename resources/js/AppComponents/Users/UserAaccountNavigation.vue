<script setup>
import {usePage} from "@inertiajs/vue3";

const page = usePage()
const pages = [
  {href: '/Profile', label: 'Profile'},
  {href: '/Tips', label: 'Tips'},
  {href: '/Wallet', label: 'Wallet'},
]

function activePage(url) {
  return page.url.startsWith(url)
}



</script>

<template>
  <div class="hidden md:block w-[250px] mr-[10px] p-1 border-r-2 border-gray-600" >
    <ul class="mr-3">
      <Link as="li" :href="link.href" v-for="link in pages" :class="{'active':activePage(link.href)}" class="p-1 mb-5 text-white rounded-sm">{{link.label}}</Link>
    </ul>
  </div>

</template>

<style lang="scss" scoped>
ul{
  li{
    @apply text-sm font-medium flex items-center;
    padding: 0.5rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    &:hover{
      background-color: rgba(0, 0, 0, 0.1);
    }
  }
  .active{
    @apply bg-orange-600 text-white;
  }
}
</style>
