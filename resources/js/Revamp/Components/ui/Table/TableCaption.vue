<template>
    <caption :class="captionClasses">
        <slot/>
    </caption>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const captionClasses = computed(() => {
    const baseClasses = 'mt-4 text-sm text-muted-foreground'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
