<template>
    <h1 :class="titleClasses">
        <slot/>
    </h1>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const titleClasses = computed(() => {
    const base = 'text-lg font-semibold leading-none tracking-tight'
    return props.class ? `${base} ${props.class}` : base
})
</script>
