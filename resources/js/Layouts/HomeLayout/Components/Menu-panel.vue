<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import links from "@/Layouts/HomeLayout/ComponentData/link.js";

const page = usePage()
const pages = [
  {href: '/Profile', label: 'Accounts'},
  {href: '/Tips', label: 'Tips'},
  {href: '/Transactions', label: 'Transactions'},
]

function activePage(url) {
  return page.url.startsWith(url)
}
</script>

<template>
  <div id="main-site-menu" class="menu-item">
    <ul class="flex flex-col">
      <Link v-for="link in links" :class="{'active': $page.url === link.link}" :href="link.link">{{ link.title }}</Link>
      <template v-if="!$page?.props?.auth?.user">
        <Link :class="{'active': $page.url === '/sign-up'}" href="/sign-up">Sign Up</Link>
        <Link :class="{'active': $page.url === '/sign-in'}" href="/sign-in">Sign In</Link>
      </template>
      <template v-else>
        <Link  v-for="link in pages" :class="{'active':activePage(link.href)}" :href="link.href">{{link.label}}</Link>
      </template>
    </ul>
  </div>
</template>

<style lang="scss" scoped>
#main-site-menu {
  position: fixed;
  right: 100%;
  transition: all ease 250ms;
  z-index: 1000;
  @apply w-full h-[calc(100vh_-_80px)] bg-gray-900 md:hidden;

  a {
    @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
  }

  a.active {
    @apply text-orange-400;
  }
}
</style>
