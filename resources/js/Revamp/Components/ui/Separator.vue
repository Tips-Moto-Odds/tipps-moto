<template>
    <div
        :class="separatorClasses"
        role="separator"
        :aria-orientation="orientation"
    />
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    orientation: {
        type: String,
        default: 'horizontal'
    },
    class: String
})

const separatorClasses = computed(() => {
    const baseClasses = 'shrink-0 bg-border'
    const orientationClasses = props.orientation === 'horizontal'
        ? 'h-[1px] w-full'
        : 'h-full w-[1px]'
    const classes = `${baseClasses} ${orientationClasses}`
    return props.class ? `${classes} ${props.class}` : classes
})
</script>
