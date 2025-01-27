<script setup>
import {usePage} from "@inertiajs/vue3";
import {ref, useAttrs} from "vue";

const page = usePage()
const attr = useAttrs()
const appPaths = [
    {
        name: "Home",
        path: route('Home')
    },
    // {
    //     name: "Tips",
    //     path: route('tips')
    // },
    {
        name: "Dashboard",
        path: route('subscriptions')
    },
    {
        name: "Account",
        path: route('dashboard')
    }
]

console.log(route().current())

const currentPage = () => {
    switch (route().current()) {
        case "Home":
            return "Home"
        // case "tips":
        //     return "Tips"
        case "subscriptions":
            return "Dashboard"
        case "dashboard":
            return "Account"
        default:
            return "Tips Moto"
    }
}

function dropDownMenu() {
    if ($('#home-menu').height() > 100) {
        $('#home-menu').css('height', '70px')
    } else {
        $('#home-menu').css('height', '280px')
    }
}
</script>
<template>
    <div class="bg-[#f4660d] w-full p-[10px]" style="position: fixed;top: 0px;z-index: 2000"></div>
    <div id="home-menu"
         class="flex justify-between mb-[20px] !mx-[10px] mt-[5px] px-[20px] rounded shadow bg-[#d88731] h-[70px] transition duration-200 ease-in-out overflow-hidden">
        <div class="text-white  py-[3px] rounded ">
            <img class="w-[60px] p-1" src="/storage/System/Icons/logo-dark.png">
        </div>
        <ul class="p-[15px] gap-xl-2 m-0 w-[90%] flex flex-col lg:hidden lg:w-fit lg:flex-row lg:pt-[40px]">
            <li class="menu-button lg:hidden">{{ currentPage() }}</li>
            <template v-for="linker in appPaths">
                <Link v-if="linker.name != currentPage()" class="menu-button" as="li" :href="linker.path">{{ linker.name }}</Link>
            </template>
        </ul>
        <ul class="hidden p-[15px] gap-xl-2 m-0 w-[90%] lg:flex flex-col lg:w-fit lg:flex-row lg:pt-[40px]">
            <li class="menu-button lg:hidden">{{ currentPage() }}</li>
            <template v-for="linker in appPaths">
                <Link  class="menu-button" as="li" :class="{'active':linker.name == currentPage()}" :href="linker.path">{{ linker.name }}</Link>
            </template>
        </ul>
        <div class="lg:hidden pt-[5px]">
            <i class="bi text-[40px] text-white bi-list" @click.prevent="dropDownMenu"></i>
        </div>
    </div>
</template>
<style lang="scss" scoped>
#home-menu {
    transition: all ease 0.5s;
    position: sticky !important;
    top: 10px;
    z-index: 5000;
}

.menu-button {
    @apply text-white text-center w-[130px] bg-[#353538] self-center mb-[25px] text-[16px] md:w-[120px] px-3 py-2 rounded-[6px] hover:bg-[#555562] cursor-pointer lg:mx-[10px];
}

.menu-button.active {
    @apply hidden md:block md:bg-black text-[#d88731];
}
</style>
