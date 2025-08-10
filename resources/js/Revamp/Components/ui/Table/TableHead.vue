<template>
    <th :class="headClasses">
        <slot/>
    </th>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const headClasses = computed(() => {
    const baseClasses = 'h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
