<script setup>
import {closeSideBar} from "@/HelperFunctions/modalControl.js";

const props = defineProps(['title'])

</script>
<template>
    <div class="right-panel fixed closed">
        <div class="w-full h-full p-[10px] bg-gray-700 shadow-xl">
            <div class="flex justify-between">
                <h1 class="text-2xl text-white">{{ title }}</h1>
                <div>
                    <button class="bg-red-400 text-white text-sm px-[3px] py-[5px] rounded" @click="closeSideBar">Close</button>
                </div>
            </div>
            <section>
                <slot></slot>
            </section>
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
