<template>
    <tr :class="rowClasses">
        <slot/>
    </tr>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const rowClasses = computed(() => {
    const baseClasses = 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
