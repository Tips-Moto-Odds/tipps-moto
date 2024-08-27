<script setup>
import {get_routes} from "@/AppData/Modules.js";
import {usePage} from "@inertiajs/vue3";

const page = usePage();

const routes = get_routes(page.props.account_type)

function closeMenu(){
    let elem = $("#dashboard-menu")

    elem.css({
        left:"-100%",
        width:"100%"
    })
}

</script>

<template>
    <section class="menu-section w-[300px] text-white h-full overflow-auto text-sm border-r border-r-gray-500">
        <div class="flex justify-between">
            <div class="logo w-[90%] lg:w-full flex p-[10px] items-center justify-center">
                <img class=" h-[80px]" src="/storage/System/Icons/logo-dark.png" alt="image">
            </div>
            <button @click="closeMenu" type="button" class=" lg:hidden flex p-[10px] items-center justify-center h-full w-[50px] mr-[3px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </button>
        </div>

        <div v-for="nav in routes" class="px-[15px] mb-[5px]">
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
