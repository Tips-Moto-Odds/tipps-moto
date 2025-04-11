<script setup>
import {ref, watch} from 'vue'
import {closeSideBar} from "@/HelperFunctions/modalControl.js"

const props = defineProps(['simpleFilter'])

const selectedFilter = ref(props.simpleFilter)

// Optional: emit selected filter if parent handles filtering
const emit = defineEmits(["filterChanged"])

watch(selectedFilter, (newVal) => {
    emit("filterChanged", newVal)
})
</script>

<template>
    <div class="right-panel fixed closed">
        <div class="w-full h-full p-[10px] bg-gray-700 shadow-xl">
            <div class="flex justify-between">
                <h1 class="text-2xl text-white">Filter Tips</h1>
                <button class="bg-red-400 text-white text-sm px-[3px] py-[5px] rounded" @click="closeSideBar">
                    Close
                </button>
            </div>

            <section class="w-full mb-2 text-white flex flex-col gap-1">
                <h5 class="underline">Simple Filters</h5>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="past"
                        value="past"
                        v-model="selectedFilter"
                        name="filter"
                    />
                    <label class="form-check-label" for="past">Past Games</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="today"
                        value="today"
                        v-model="selectedFilter"
                        name="filter"
                    />
                    <label class="form-check-label" for="today">Today's Games</label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="tomorrow"
                        value="tomorrow"
                        v-model="selectedFilter"
                        name="filter"
                    />
                    <label class="form-check-label" for="tomorrow">Tomorrow's Games</label>
                </div>
            </section>
            <hr style="border: 1px solid" class="border-white"/>
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
