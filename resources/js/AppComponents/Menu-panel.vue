<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div id="main-site-menu" class="menu-item  w-full h-[calc(100vh_-_80px)] bg-gray-900">
        <ul class="flex flex-col">
            <Link href="/"  :class="{'active': $page.url === '/'}" >Home</Link>
            <Link href="/about"  :class="{'active': $page.url === '/about'}" >About</Link>
            <Link href="/contact"  :class="{'active': $page.url === '/contact'}" >Contact</Link>
            <Link href="/profile"  :class="{'active': $page.url === '/profile'}" >Profile</Link>
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
