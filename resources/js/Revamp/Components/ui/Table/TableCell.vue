<template>
    <td :class="cellClasses">
        <slot/>
    </td>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const cellClasses = computed(() => {
    const baseClasses = 'p-4 align-middle [&:has([role=checkbox])]:pr-0'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
