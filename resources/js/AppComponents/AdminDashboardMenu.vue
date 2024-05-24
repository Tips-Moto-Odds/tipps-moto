<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <section class="menu-section w-[300px]  h-full overflow-auto text-sm border-r border-r-gray-500">
        <div class="logo w-full flex p-[10px] items-center justify-center">
            <img class=" h-[80px]" src="/storage/System/Icons/logo-dark.png">
        </div>

        <div class="px-[15px] mb-[5px]">
            <h2 class="text-white">Dashboard</h2>
            <ul class="p-[10px]">
                <Link :href="route('dashboard')" :class="{'active': $page.url === '/dashboard'}"
                      class="menu-button">
                    <img width="24" height="24"
                         src="https://img.icons8.com/material-outlined/24/ffffff/dashboard-layout.png"
                         alt="dashboard-layout" class="inline"/>
                    <p class="inline">Dashboard</p>
                </Link>
            </ul>
        </div>

        <hr class="w-[90%] mx-auto border-gray-600 mb-[10px]">

        <div class="px-[15px] mb-[5px]">
            <h2 class="text-white">Profile</h2>
            <ul class="p-[10px]">
                <Link :href="route('ViewProfile')" :class="{'active': $page.url === '/Profile'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/guest-male.png"
                         alt="guest-male"/>
                    <p>Account</p>
                </Link>
            </ul>
        </div>
        <hr class="w-[90%] mx-auto border-gray-600 mb-[10px]">
        <div class="px-[15px] mb-[5px]">
            <h2 class="text-white">Manage</h2>
            <ul class="p-[10px]">
                <Link :href="route('manage.accounts')" :class="{'active': $page.url === '/accounts'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/share_2.png"
                         alt="share_2"/>
                    <p>Accounts</p>
                </Link>
                <Link :href="route('dashboard')" :class="{'active': $page.url === '/account'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/two-tickets.png"
                         alt="two-tickets"/>
                    <p>Tips</p>
                </Link>
                <Link :href="route('dashboard')" :class="{'active': $page.url === '/account'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/windows/32/ffffff/paper-money-1.png"
                         alt="paper-money-1"/>
                    <p>Transactions</p>
                </Link>
                <Link :href="route('dashboard')" :class="{'active': $page.url === '/account'}"
                      class="menu-button">
                    <img width="24" height="24"
                         src="https://img.icons8.com/material-outlined/24/ffffff/push-notifications.png"
                         alt="push-notifications"/>
                    <p>Notifications</p>
                </Link>
            </ul>
        </div>

        <hr class="w-[90%] mx-auto border-gray-600 mb-[10px]">

        <div class="px-[15px] mb-[5px]">
            <h2 class="text-white">Administration</h2>
            <ul class="p-[10px]">
                <Link :href="route('dashboard')" :class="{'active': $page.url === '/account'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/artificial-intelligence.png"
                         alt="artificial-intelligence"/>
                    <p>Model</p>
                </Link>
                <Link :href="route('ListAccountTypes')" :class="{'active': $page.url === '/AccountTypes'}"
                      class="menu-button">
                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/microsoft-teams-2019.png"
                         alt="microsoft-teams-2019"/>
                    <p>Account Type</p>
                </Link>
<!--                <Link :href="route('dashboard')" :class="{'active': $page.url === '/account'}"-->
<!--                      class="menu-button">-->
<!--                    <img width="24" height="24" src="https://img.icons8.com/ios/50/ffffff/imac-settings.png"-->
<!--                         alt="imac-settings"/>-->
<!--                    <p>System</p>-->
<!--                </Link>-->
            </ul>
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
        @apply rounded py-[6px] px-[8px] text-white  flex gap-2 items-center;

        &:hover {
            @apply bg-orange-500;
        }
    }
}

</style>
