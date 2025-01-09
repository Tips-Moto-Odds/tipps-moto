<script setup>
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";

const page = usePage()

const currentPage = () => {
    switch (page.url) {
        case "/":
            return "Home"
        case "/tips":
            return "Tips"
        case "/contact":
            return "Tips"
        default:
            return "Tips Moto"
    }
}

function dropDownMenu() {
    if ($('#home-menu').height() > 100) {
        $('#home-menu').css('height', '70px')
    } else {
        $('#home-menu').css('height', '300px')
    }
}
</script>
<template>
    <div id="home-menu"
         class="flex justify-between mb-[20px] !mx-[10px] mt-[10px] px-[20px] rounded shadow bg-[#d88731] h-[70px] transition duration-200 ease-in-out lg:mt-[20px] overflow-hidden">
        <div class="text-white  py-[3px] rounded ">
            <img class="w-[60px] p-1" src="storage/System/Icons/logo-dark.png">
        </div>
        <ul class="p-[15px] gap-xl-2 m-0 w-[90%] flex flex-col lg:w-fit lg:flex-row lg:pt-[40px]">
            <li class="menu-button lg:hidden">{{currentPage()}}</li>
            <Link class="menu-button" :class="{'active':page.url == '/'}" href="/" as="li">Home</Link>
            <Link class="menu-button" :class="{'active':page.url == '/tips'}" href="/tips" as="li">Tips</Link>
            <Link class="menu-button" :class="{'active':page.url == '/dashboard'}" href="/dashboard" as="li">Dashboard</Link>
            <Link class=" text-black hidden lg:block rounded menu-button" href="/dashboard" as="li">
                <i class="bi bi-person-circle text-white text-[30px]"></i>
            </Link>
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
    top: 5px;
    z-index: 5000;
}

.menu-button {
    @apply text-white text-center bg-[#353538] self-center mb-[25px] text-[16px] w-[100px] md:w-fit px-3 py-2 rounded-[6px] hover:bg-gray-500 cursor-pointer lg:mx-[10px];
}

.menu-button.active {
    @apply md:bg-orange-500;
}
</style>
