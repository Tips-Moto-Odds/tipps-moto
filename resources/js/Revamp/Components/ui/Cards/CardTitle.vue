<template>
    <h3 :class="titleClasses">
        <slot/>
    </h3>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const titleClasses = computed(() => {
    const base = 'text-sm font-medium text-gray-900'
    return props.class ? `${base} ${props.class}` : base
})
</script>
