<template>
    <div :class="separatorClasses"/>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const separatorClasses = computed(() => {
    const base = '-mx-1 my-1 h-px bg-muted'
    return props.class ? `${base} ${props.class}` : base
})
</script>
