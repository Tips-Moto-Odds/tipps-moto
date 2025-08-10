<template>
    <div :class="fallbackClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const fallbackClasses = computed(() => {
    const base = 'flex h-full w-full items-center justify-center rounded-full bg-muted'
    return props.class ? `${base} ${props.class}` : base
})
</script>
