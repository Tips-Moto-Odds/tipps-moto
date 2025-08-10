<template>
    <div :class="headerClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const headerClasses = computed(() => {
    const base = 'p-4 flex flex-row items-center justify-between'
    return props.class ? `${base} ${props.class}` : base
})
</script>
