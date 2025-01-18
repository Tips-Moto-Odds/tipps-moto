<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";

const props = defineProps(['subscriptions'])
</script>

<template>
    <Head>
        <title>Welcome</title>
    </Head>
    <Navigation/>
    <div class="container flex flex-col md:flex-row text-white flex gap-2">
        <div class=" w-full  md:w-[70%] bg-black p-[20px]">
            <h1 class="mb-[10px]">Subscriptions</h1>
            <hr class="border border-white bg-white" />
            <div v-if="subscriptions.length >  0" class="flex mb-[20px] justify-between items-center">
                <table>
                    <thead>
                    <tr>
                        <th class="!px-[10px]">Package</th>
                        <th class="text-center">Status</th>
                        <th>Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="subscription in subscriptions">
                        <Link  as="tr" :href="route('dashboard.tips.subscriptions-tips',subscription.id)"  class="!text-sm" >
                            <th class="p-[5px] max-w-[100px]">{{subscription.package_name}}</th>
                            <th class=" w-[60px]">
                                <div v-if="subscription.status == 1" class="bg-green-500 mx-auto w-[10px] h-[10px] rounded-[50%]"></div>
                                <div v-else class="bg-red-500 mx-auto w-[10px] h-[10px] rounded-[50%]"></div>
                            </th>
                            <th>
                                <p>{{subscription.end_date}}</p>
                            </th>
                        </Link>
                    </template>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <p class="p-[20px] text-center">No subscription available</p>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>

.container {
    div{
        @apply rounded-lg;
    }
}

</style>
