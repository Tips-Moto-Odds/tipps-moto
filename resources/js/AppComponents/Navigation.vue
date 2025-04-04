<script setup>
import {usePage} from "@inertiajs/vue3";
import {ref, nextTick} from "vue";

const page = usePage();
const isMenuOpen = ref(false);
const homeMenu = ref(null); // Reference to the menu container
const menuHeight = ref("70px"); // Default collapsed height

// Navigation paths
const appPaths = [
    { name: "Home", path: route('Home') },
    { name: "Tips", path: route('tips') },
    { name: "Subscriptions", path: route('profile.subscription') },
    { name: "Account", path: route('dashboard') }
];

// Dynamic lookup for current page
const pageNames = {
    "Home": "Home",
    "tips": "Tips",
    "subscriptions": "Dashboard",
    "dashboard": "Account",
    "profile.subscription": "Subscriptions",
    "profile.tips": "Subscriptions"
};

// Function to determine the current page name
const currentPage = () => pageNames[route().current()] || "Tips Moto";

// Toggle dropdown menu dynamically
const dropDownMenu = async () => {
    isMenuOpen.value = !isMenuOpen.value;

    await nextTick(); // Ensure DOM updates before measuring height

    if (isMenuOpen.value && homeMenu.value) {
        menuHeight.value = `${homeMenu.value.scrollHeight + 10}px`; // Dynamically fit content with extra padding
    } else {
        menuHeight.value = "70px"; // Collapse back to original height
    }
};
</script>

<template>
    <div class="bg-[#f4660d] w-full p-[10px]" style="position: fixed; top: 0px; z-index: 2000"></div>

    <div id="home-menu" ref="homeMenu"
         class="container mx-auto flex justify-between mb-[20px] mt-[5px] rounded shadow bg-[#d88731] overflow-hidden"
         :style="{ height: menuHeight }">

        <!-- Logo -->
        <Link :href="'/'" as="div" class="w-[50px] pt-[20px] flex items-center justify-center h-[50px] align-self-start">
            <img class=" md:w-[50px]" src="/storage/System/Icons/logo-dark.png">
        </Link>

        <!-- Navigation List -->
        <ul class="p-[15px] gap-xl-2 m-0 flex flex-col lg:flex-row lg:w-fit lg:pt-[40px]">
            <li class="menu-button lg:hidden">{{ currentPage() }}</li>
            <template v-for="(linker, index) in appPaths" :key="linker.path">
                <Link class="menu-button text-decoration-none"
                      :class="{'active': linker.name === currentPage(), 'last-item': index === appPaths.length - 1}"
                      :href="linker.path">
                    {{ linker.name }}
                </Link>
            </template>
        </ul>

        <!-- Mobile Menu Toggle Button -->
        <div class="lg:hidden pt-[5px]">
            <i class="bi text-[40px] text-black bi-list" @click="dropDownMenu"></i>
        </div>
    </div>
</template>

<style lang="scss" scoped>
#home-menu {
    transition: height 0.3s ease-in-out; /* Smooth dropdown animation */
    position: sticky !important;
    top: 10px;
    z-index: 5000;
}

.menu-button {
    @apply text-white w-[130px] text-center shadow-inner  bg-[#353538] self-center mb-[25px] text-[16px] md:w-[130px] px-3 py-2 rounded-[6px] hover:bg-[#555562] cursor-pointer lg:mx-[10px];
}

.menu-button.active {
    @apply hidden md:block md:bg-black text-[#d88731] shadow-sm shadow-[rgba(0,0,0,0.25)];
}
</style>
