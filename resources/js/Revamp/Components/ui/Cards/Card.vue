<template>
    <div :class="cardClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const cardClasses = computed(() => {
    const base = 'rounded-xl border border-gray-200 bg-white'
    return props.class ? `${base} ${props.class}` : base
})
</script>
