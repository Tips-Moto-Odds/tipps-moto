<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import Navigation from "@/AppComponents/Navigation.vue";
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
            <div class="flex mb-[20px] justify-between items-center">
                <table>
                    <thead>
                    <tr>
                        <th class="!px-[10px]">Package</th>
                        <th class="text-center">Status</th>
                        <th>Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody >
                    <Link as="tr" :href="route('dashboard.tips.subscriptions-tips',[1])" v-for="user in 10" class="!text-sm" >
                        <th class="p-[5px] max-w-[100px]">Sport Pesa Mid Week Jackpot</th>
                        <th class=" w-[60px]">
                            <div class="bg-green-500 mx-auto w-[10px] h-[10px] rounded-[50%]"></div>
                        </th>
                        <th>
                            <p>00/00/0000</p>
                            <p>00:00</p>
                        </th>
                    </Link>
                    </tbody>
                </table>
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
