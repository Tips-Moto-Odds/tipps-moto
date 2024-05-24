<script setup>
import AdminDashboardMenu from "@/AppComponents/AdminDashboardMenu.vue";
import AppPageHeading from "@/AppComponents/AppPageHeading.vue";
import {Head ,Link} from "@inertiajs/vue3";

const props = defineProps({
    accountTypes: {
        type: Array,
        default: []
    }
});
</script>


<template>
    <Head title="Dashboard"/>
    <div class="holder w-full h-[100vh] flex">
        <admin-dashboard-menu/>
        <section class="content-area w-full h-full overflow-auto">
            <app-page-heading :pageHeading="'Account Types'"/>

            <div class="p-[10px] w-[99%] mx-auto rounded flex">
                <ul class="flex gap-2.5">
                    <Link :href="route('CreateAccountType')" class="bg-gray-500 text-white text-sm px-[10px] py-[5px] rounded-sm">Add New</Link>
                </ul>
                <div>

                </div>
            </div>

            <div class="p-[10px] w-[99%] mx-auto rounded">
                <ul class="m-[10px] flex gap-2.5 flex-wrap" v-if="accountTypes?.length > 0">
                    <Link :href="route('ViewAccountByIDs',[item])" v-for="item in accountTypes" class=" w-[200px] h-[150px] bg-gray-600 shadow-xl rounded p-[15px] hover:bg-gray-500 cursor-pointer">
                        <h3 class="text-white mb-1">{{item.name}}</h3>
                        <ul class="px-[10px] text-sm text-white">
                            <li class="flex justify-between mb-1.5">
                                <p>User Count</p>
                                <p>{{item.user_count}}</p>
                            </li>
                            <li class="flex justify-between">
                                <p>Status</p>
                                <p>{{ item.status }}</p>
                            </li>
                        </ul>
                    </Link>
                </ul>
            </div>
        </section>
    </div>
</template>


<style scoped lang="scss">
table {
    tbody {
        tr {
            border-bottom: 2px solid gray;
            @apply rounded-sm overflow-hidden text-xs;

            td {
                vertical-align: top;
                @apply pt-[10px];
            }

            &:hover {
                cursor: pointer;
                background-color: #575454;
            }
        }
    }
}
</style>
