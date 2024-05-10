<script setup>
import {Link} from "@inertiajs/vue3";
import links from "@/AppData/link.js";

</script>

<template>
    <div id="main-site-menu" class="menu-item  w-full h-[calc(100vh_-_80px)] bg-gray-900 md:hidden">
        <ul class="flex flex-col">
            <Link v-for="link in links" :href="link.link"  :class="{'active': $page.url === link.link}" >{{link.title}}</Link>

            <Link v-if="!$page?.props?.auth?.user" href="/sign-up"  :class="{'active': $page.url === '/sign-up'}" >Sign Up</Link>
            <Link v-if="!$page?.props?.auth?.user" href="/sign-in"  :class="{'active': $page.url === '/sign-in'}" >Sign In</Link>
            <Link v-else href="/dashboard">Profile</Link>
        </ul>
    </div>
</template>

<style scoped lang="scss">
#main-site-menu {
    position: fixed;
    right: 100%;
    transition: all ease 250ms;
    z-index: 1000;

    a{
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active{
        @apply text-orange-400;
    }
}
</style>
