<script setup>
import {Link, useForm, usePage} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {useDateFormat} from "@vueuse/shared";
import Pagination from "@/AppComponents/Global/Pagination.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";

const props = defineProps(['transactions', 'stats'])
const page = usePage()
const pageController = useForm({
    search: props.search
});

</script>

<template>
    <DashboardLayout page-heading="Transactions" title="Transactions">
        <div class="flex gap-3 px-[10px] mb-4">
            <div class="app-panel flex justify-between w-full">
                <div></div>
                <div>
                    <div>
                        <input
                            id="search"
                            v-model="pageController.search"
                            class="rounded-lg"
                            placeholder="Search"
                            type="search"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-3 px-[10px]">
            <div class="app-panel w-full">
                <div class="app-panel-heading flex justify-between items-center">
                    <h4>All Transactions</h4>
                </div>
                <div>
                    <table class="text-white w-full mb-[20px] table-sm">
                        <thead class="h-[50px] ">
                        <tr class="text-left border-b-[2px] text-xs">
                            <th class="text-center">ID</th>
                            <th class="w-[150px]">User</th>
                            <th class="text-center">Package</th>
                            <th class="">Amount(Ksh)</th>
                            <th class="text-center">Date/Time</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Reference</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="(transaction, index) in transactions.data" :key="transaction.id">
                            <tr>
                                <td class="text-center">{{ transaction.id }}</td>
                                <td class="">
                                    <p>{{ transaction.user_name }}</p>
                                    <p class="text-gray-300 text-sm">{{ transaction.user_email }}</p>
                                </td>
                                <td class="text-center">{{ transaction.package_name }}</td>
                                <td class="text-right">{{ transaction.amount }}</td>
                                <td class="text-center">
                                    <p>{{ useDateFormat(transaction.created_at, 'MM/DD/YYYY').value }}</p>
                                    <p class="text-gray-300 text-sm">{{ useDateFormat(transaction.created_at, 'HH:mm').value }}</p>
                                </td>
                                <td>
                                    <p v-if=" transaction.transaction_status  == 'pending'" class="text-orange-300 text-center">{{ transaction.transaction_status }}</p>
                                    <p v-else class="text-green-400 text-center">{{ transaction.transaction_status }}</p>
                                </td>
                                <td class="text-center">{{ transaction.transaction_reference }}</td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                    <div>
                        <Pagination :pagination="transactions.links"/>
                    </div>
                </div>
            </div>
            <div class="w-4/12">
                <div class="app-panel">
                    <div class="app-panel-heading">
                        <h4>Summary</h4>
                    </div>
                    <div class="list-display text-white" v-for="(item,title) in stats">
                        <h4>{{title}}</h4>
                        <ul class="text-sm">
                            <li class="flex justify-between items-center mb-[10px]" v-for="(record,title1) in item">
                                <p>{{title1}}</p>
                                <p>{{ stats[title][title1] }}</p>
                            </li>
                        </ul>
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
