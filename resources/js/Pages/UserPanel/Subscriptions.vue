<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";

const props = defineProps(['subscriptions'])

// const subscriptions = []
function openSubMenu() {
    let slideMenuHolder = $('#slide-menu-holder')
    let element = $('#slide-menu')

    slideMenuHolder.fadeIn()

    element.animate({
        left: '0%'
    })
}

function closeSubMenu() {
    let slideMenuHolder = $('#slide-menu-holder')
    let element = $('#slide-menu')

    slideMenuHolder.fadeOut()

    element.animate({
        left: '-80%'
    })
}
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="w-[95%] mx-auto md:container bg-black p-[10px] rounded">
        <!-- Content Section -->
        <div class="flex items-center p-0 border-bottom rounded-0">
            <h3 class="m-0 text-app_white">Subscriptions</h3>
        </div>
        <div v-if="subscriptions.length > 0" class="text-sm flex  justify-between items-center">
            <table>
                <thead>
                <tr class="!text-[12px]">
                    <th class="!px-[10px]">Package</th>
                    <th>Expiry Date</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="subscription in subscriptions">
                    <Link as="tr" :href="route('dashboard.tips.subscriptions-tips',subscription.id)" class="!text-[12px]">
                        <th class="p-[10px] max-w-[100px]">{{ subscription.package_name }}</th>
                        <th class="w-[75px]">
                            {{ subscription.end_date }}
                        </th>
                    </Link>
                </template>
                </tbody>
            </table>
        </div>
        <div v-else>
            <p class="p-[20px] text-white text-center">No subscription available</p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.container {
    div {
        @apply rounded-lg;
    }
}
</style>
