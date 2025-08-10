<template>
    <div
        v-if="isOpen?.value"
        :class="contentClasses"
        class="absolute top-full left-0 z-50 mt-1 w-full"
    >
        <slot/>
    </div>
</template>

<script setup>
import {inject, computed} from 'vue'

const props = defineProps({class: String})
const selectContext = inject('selectContext')
const isOpen = selectContext?.isOpen

const contentClasses = computed(() => {
    const base = 'relative z-50 max-h-96 min-w-[8rem] overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-md animate-in fade-in-80'
    return props.class ? `${base} ${props.class}` : base
})
</script>
