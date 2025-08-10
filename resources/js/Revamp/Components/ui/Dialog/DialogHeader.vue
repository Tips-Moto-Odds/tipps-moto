<template>
    <div :class="headerClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const headerClasses = computed(() => {
    const base = 'flex flex-col space-y-1.5 text-center sm:text-left p-6 pb-0'
    return props.class ? `${base} ${props.class}` : base
})
</script>
