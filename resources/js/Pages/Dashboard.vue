<script setup>

import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import AdminDashboard from "@/Pages/Dashboards/Administrator/Dashboard/AdminDashboard.vue";
import {usePage} from "@inertiajs/vue3";
import UserDashboard from "@/Pages/Dashboards/User/Dashboard/UserDashboard.vue";

const props = defineProps([
    'users',
    'payments',
    'model'
]);

const page = usePage()

</script>


<template>
    <DashboardLayout :title="'Dashboard'" :page-heading="'Welcome Back'">
        <AdminDashboard v-if="page.props.account_type === 'Administrator'"  :model="model" :users="users" :payments="payments"/>
        <UserDashboard  v-else-if="page.props.account_type === 'user'"/>
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
