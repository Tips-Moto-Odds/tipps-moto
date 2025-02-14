<script setup>
import { useForm } from "@inertiajs/vue3";
import { closeSideBar } from "@/HelperFunctions/modalControl.js";

const props = defineProps(['title'])

const filterForm = useForm({
    date: "",  // Matches for today
    from: "",  // Start time filter
    to: "",    // End time filter
    played: false, // Played matches (2+ hours past match time)
});

// Apply Filters
const applyFilters = () => {
    filterForm.get(route("dashboard.matches.listMatches"), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>

<template>
    <div class="right-panel fixed closed hidden md:block">
        <div class="w-full h-full p-[10px] bg-gray-700 shadow-xl">
            <div class="flex justify-between">
                <h1 class="text-2xl text-white">{{ title ?? 'Filters' }}</h1>
                <div>
                    <button class="bg-red-400 text-white text-sm px-[3px] py-[5px] rounded" @click="$emit('close')">Close</button>
                </div>
            </div>

            <!-- Conditional Rendering -->
            <div v-if="$slots.default">
                <slot></slot>
            </div>
            <div v-else class="mt-4 space-y-4">
                <!-- Filters Section -->
                <!-- Matches for Today -->
                <div>
                    <label class="text-white font-semibold">Matches for Today</label>
                    <input type="checkbox" v-model="filterForm.date" value="today" class="ml-2">
                </div>

                <!-- Played Matches (More than 2 Hours Ago) -->
                <div>
                    <label class="text-white font-semibold">Played Matches (2+ Hours Ago)</label>
                    <input type="checkbox" v-model="filterForm.played" class="ml-2">
                </div>

                <!-- Date Range Filters -->
                <div>
                    <label class="text-white font-semibold">From</label>
                    <input type="datetime-local" v-model="filterForm.from" class="block w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
                </div>

                <div>
                    <label class="text-white font-semibold">To</label>
                    <input type="datetime-local" v-model="filterForm.to" class="block w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
                </div>

                <!-- Apply Button -->
                <div class="mt-4 flex justify-end">
                    <button @click="applyFilters" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss" scoped>
.right-panel {
    @apply w-[400px] h-full z-[5000] shadow-sm;
}

.closed {
    right: -100%;
}
</style>
