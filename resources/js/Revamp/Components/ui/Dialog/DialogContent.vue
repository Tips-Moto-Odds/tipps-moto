<template>
    <div :class="contentClasses" @click.stop>
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const contentClasses = computed(() => {
    const base = 'relative z-50 w-full max-w-lg mx-4 bg-background border rounded-lg shadow-lg animate-in fade-in-90 slide-in-from-bottom-10 sm:max-w-md'
    return props.class ? `${base} ${props.class}` : base
})
</script>
