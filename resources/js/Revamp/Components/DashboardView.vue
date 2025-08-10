<!-- resources/js/Pages/DashboardView.vue -->
<template>
    <div class="max-w-7xl mx-auto space-y-6">
        <StatsCards :matches="matches"/>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <IncomeSummary/>
            <RecentPurchases @page-change="onPageChange"/>
        </div>
    </div>
</template>

<script setup>
import IncomeSummary from "@/Revamp/Components/IncomeSummary.vue";
import RecentPurchases from "@/Revamp/Components/RecentPurchases.vue";
import StatsCards from "@/Revamp/Components/StatsCards.vue";

defineProps({
    matches: Array,
    onPageChange: Function,
})
</script>
