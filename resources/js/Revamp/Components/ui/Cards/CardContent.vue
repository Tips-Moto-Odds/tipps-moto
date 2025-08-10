<template>
    <div :class="contentClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const contentClasses = computed(() => {
    const base = 'p-4 pt-2'
    return props.class ? `${base} ${props.class}` : base
})
</script>
