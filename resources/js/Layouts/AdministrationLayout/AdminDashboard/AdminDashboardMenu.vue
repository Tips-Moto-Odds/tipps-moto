<script setup>
import {Link} from "@inertiajs/vue3";
import Modules from "@/AppData/Modules.js";
</script>

<template>
    <section class="menu-section w-[300px] text-white h-full overflow-auto text-sm border-r border-r-gray-500">
        <div class="logo w-full flex p-[10px] items-center justify-center">
            <img class=" h-[80px]" src="/storage/System/Icons/logo-dark.png" alt="image">
        </div>

        <div v-for="nav in Modules" class="px-[15px] mb-[5px]">
            <h2>{{ nav.name }}</h2>
            <ul>
                <template v-for="link in nav.links" :key="link.name">
                    <Link :href="link.link" :class="{'active': $page.url.includes(link.active)}" class="menu-button">
                        <img :src="link.icon" alt="menu-icon" class="inline w-[24px] h-[24px]"/>
                        <p class="inline">{{ link.name }}</p>
                    </Link>
                </template>
            </ul>
            <hr style="border-color: #505050">
        </div>
    </section>
</template>

<style scoped lang="scss">
.menu-section {
    .active {
        @apply bg-orange-400 text-white;
    }

    .menu-button {
        transition: all ease 150ms;
        @apply rounded py-[6px] px-[8px] text-white  flex gap-2 items-center  mb-[5px];

        &:hover {
            @apply bg-orange-500;
        }

    }

    h2 {
        @apply mb-[10px]
    }

    hr {
        @apply my-[10px];
    }
}
</style>
