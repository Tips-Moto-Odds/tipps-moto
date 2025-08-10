<template>
    <p :class="descriptionClasses">
        <slot/>
    </p>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const descriptionClasses = computed(() => {
    const base = 'text-sm text-muted-foreground'
    return props.class ? `${base} ${props.class}` : base
})
</script>
