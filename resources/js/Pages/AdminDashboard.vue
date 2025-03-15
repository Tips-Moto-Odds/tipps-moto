<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import AdminDashboard from "@/Pages/Dashboards/Administrator/Dashboard/AdminDashboard.vue";
import {usePage} from "@inertiajs/vue3";

const props = defineProps([
    'label_data',
    'chart_data',
    'recent_purchases'
]);

const page = usePage()

</script>

<template>
    <DashboardLayout :title="'Dashboard'" :page-heading="'Welcome Back'">
        <AdminDashboard
            :model="label_data.model"
            :users="label_data.users"
            :payments="label_data.payments"
            :chartData="chart_data"
            :RecentPurchases="recent_purchases"
        />

    </DashboardLayout>
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
