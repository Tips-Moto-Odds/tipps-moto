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
        $('#home-menu').css('height', '340px')
    }
}
</script>
<template>
    <div id="home-menu" class="flex justify-between mb-[20px] !mx-[10px] mt-[10px] px-[20px] rounded shadow bg-gray-700 h-[70px] transition duration-200 ease-in-out md:mt-[20px] overflow-hidden">
        <div class="text-white  py-[3px] rounded ">
            <img class="w-[60px] p-1" src="storage/System/Icons/logo-dark.png">
        </div>
        <ul class="p-[15px] gap-xl-2 m-0 w-[90%] flex flex-col md:w-fit md:flex-row md:pt-[40px] ">
            <li class="menu-button md:hidden">{{currentPage()}}</li>
            <Link class="menu-button" :class="{'active':page.url == '/'}" href="/" as="li">Home</Link>
            <Link class="menu-button" :class="{'active':page.url == '/tips'}" href="/tips" as="li">Tips</Link>
            <Link class="menu-button" :class="{'active':page.url == '/contact'}" href="/contact" as="li">Contact</Link>
            <Link class="menu-button" :class="{'active':page.url == '/dashboard'}" href="/dashboard" as="li">Dashboard</Link>
            <Link class=" text-black hidden md:block rounded menu-button" href="/dashboard" as="li">
                <i class="bi bi-person-circle text-white text-[30px]"></i>
            </Link>
        </ul>
        <div class="md:hidden pt-[5px]">
            <i class="bi text-[40px] text-white bi-list" @click.prevent="dropDownMenu"></i>
        </div>
    </div>
</template>
<style lang="scss" scoped>
#home-menu {
    transition: all ease 0.5s;
    position: sticky !important;
    top: 10px;
}

.menu-button {
    @apply text-white self-center mb-[25px] text-[16px] w-[100px] md:w-fit px-3 py-2 rounded hover:bg-gray-500 cursor-pointer;
}

.menu-button.active {
    @apply md:bg-orange-500;
}
</style>
