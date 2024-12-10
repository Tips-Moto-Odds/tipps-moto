<script setup>
// import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, usePage} from "@inertiajs/vue3"
import {closeSideBar} from "@/HelperFunctions/modalControl.js";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
// import SubscriptionDetails from "@/Pages/Administration/Manage/Tips/SubscriptionDetails.vue";

const props = defineProps(['transactions', 'user_data'])
const page = usePage()
const accountType = page.props.account_type
</script>

<template>
    <DashboardLayout title="Transactions" page-heading="Transactions">
        <template v-slot:side>
            <div class="right-panel fixed closed">
                <div class="w-full h-full p-[10px] bg-gray-500 shadow-xl">
                    <div class="flex justify-between">
                        <h1 class="text-2xl text-white">Filter Tips</h1>
                        <div>
                            <button class="bg-red-400 text-white px-[3px] py-[5px] rounded" @click="closeSideBar">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="flex gap-3 px-[10px]">
            <div v-if="transactions" class="app-panel w-full">
                <div class="app-panel-heading flex justify-between items-center">
                    <h1>All Tips</h1>
                    <FilterSection v-if="accountType === 'Administrator' || accountType === 'Manager'"/>
                </div>


                <ul>
                    <li v-for="transaction in transactions.data">
                        <Link :href="'/admin/manage/tips/' + transaction.id">
                            <div class="flex gap-3 py-[10px]">
                                <div class="flex items-center">
<!--                                    <img class="w-[30px] h-[30px]" :src="transaction.user.avatar_url"/>-->
                                    <div class="flex-grow pl-[10px]">
<!--                                        <h2 class="text-lg font-semibold">{{ transaction.user.full_name }}</h2>-->
                                        <p class="text-gray-500 text-sm">{{ transaction.created_at }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">{{ transaction.description }}</span>
                                </div>
                            </div>
                            <hr class="border-gray-400">
                        </Link>
                    </li>
                </ul>

                <div>
                    <Pagination :pagination="transactions.links"/>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style lang="scss">
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
