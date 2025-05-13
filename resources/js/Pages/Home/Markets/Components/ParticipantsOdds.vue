<script setup>
defineProps({
    sportName: String,
    eventName: String,
    participants: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <div class="container bg-black p-6 rounded-md mb-4">
        <h2 class="text-2xl font-bold text-white mb-4">{{ sportName }} - {{ eventName }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div
                v-for="(p, idx) in participants"
                :key="idx"
                class="bg-orange-100 border border-orange-400 rounded-xl p-4 shadow hover:shadow-lg"
            >
                <div class="text-lg font-semibold text-gray-900">{{ p.name }}</div>
                <div class="text-sm text-gray-700">Odds: <span class="font-bold">{{ p.odds }}</span></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
