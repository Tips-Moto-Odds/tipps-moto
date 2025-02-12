<script setup>
import {ref} from "vue";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import UserCard from "@/Pages/Dashboards/Administrator/Accounts/UserCard.vue";

const props = defineProps(["user", 'transactions', 'subscriptions', "can_log_in_as_user"]);

const activeTab = ref("subscriptions"); // Default to 'subscriptions'

const switchTab = (tab) => {
    activeTab.value = tab;
};
</script>

<template>
    <DashboardLayout page-heading="View User" title="View User">
        <!-- User Card (Static) -->
        <UserCard :user="user"/>

        <!-- Tabs for Switching -->
        <div class="tabs-container mt-6">
            <div class="tabs">
                <button
                    class="tab-button"
                    :class="{ active: activeTab === 'subscriptions' }"
                    @click="switchTab('subscriptions')"
                >
                    Subscriptions
                </button>
                <button
                    class="tab-button"
                    :class="{ active: activeTab === 'transactions' }"
                    @click="switchTab('transactions')"
                >
                    Transactions
                </button>
            </div>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Subscriptions Tab -->
                <div v-if="activeTab === 'subscriptions'">
                    <h3 class="section-title">User Subscriptions</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Package</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="subscription in subscriptions" :key="subscription.id">
                            <td>{{ subscription.package_name }}</td>
                            <td>{{ subscription.start_date }}</td>
                            <td>{{ subscription.end_date }}</td>
                            <td>{{ subscription.status }}</td>
                        </tr>
                        <tr v-if="subscriptions.length === 0">
                            <td colspan="4" class="text-center text-gray-400">No Subscriptions Found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Transactions Tab -->
                <div v-if="activeTab === 'transactions'">
                    <h3 class="section-title">User Transactions</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Amount (Ksh)</th>
                            <th>Payment Method</th>
                            <th>Package Purchased</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="transaction in transactions" :key="transaction.id">
                            <td>{{ transaction.id }}</td>
                            <td>{{ transaction.amount }}</td>
                            <td>{{ 'M-Pesa' }}</td>
                            <td>{{ transaction.package }}</td>
                            <td>{{ transaction.transaction_date }}</td>
                            <td>{{ transaction.transaction_status }}</td>
                        </tr>
                        <tr v-if="transactions.length === 0">
                            <td colspan="5" class="text-center text-gray-400">No Transactions Found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped lang="scss">
/* Tabs */
.tabs {
    @apply flex border-b-2 border-gray-700 mx-[20px];
}

.tab-button {
    @apply flex-1 py-3 text-center font-bold cursor-pointer transition-all duration-300 border-none text-white;

    &:hover {
        @apply bg-gray-600;
    }

    &.active {
        @apply bg-gray-800;
    }
}

/* Tab Content */
.tab-content {
    @apply p-5  mx-[20px] bg-gray-800;
}

/* Table */
.table {
    @apply w-full border-collapse mt-4;
}

.table th, .table td {
    @apply px-4 py-3 text-left border-b border-gray-700;
}

.table th {
    @apply bg-gray-800 text-white;
}

/* Status */
.active-status {
    @apply text-green-400 font-bold;
}

.expired-status {
    @apply text-red-500 font-bold;
}

.success-status {
    @apply text-green-400 font-bold;
}

.failed-status {
    @apply text-red-500 font-bold;
}

/* Section Title */
.section-title {
    @apply text-white text-lg font-bold mb-4;
}
</style>

