<template>
    <thead :class="headerClasses">
    <slot/>
    </thead>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const headerClasses = computed(() => {
    const baseClasses = '[&_tr]:border-b'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
