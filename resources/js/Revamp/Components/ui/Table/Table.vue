<template>
    <div class="relative w-full overflow-auto">
        <table :class="tableClasses">
            <slot/>
        </table>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const tableClasses = computed(() => {
    const baseClasses = 'w-full caption-bottom text-sm'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
