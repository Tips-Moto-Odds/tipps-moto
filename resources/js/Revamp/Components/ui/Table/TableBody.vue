<template>
    <tbody :class="bodyClasses">
    <slot/>
    </tbody>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const bodyClasses = computed(() => {
    const baseClasses = '[&_tr:last-child]:border-0'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
