<template>
    <tfoot :class="footerClasses">
    <slot/>
    </tfoot>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const footerClasses = computed(() => {
    const baseClasses = 'border-t bg-muted/50 font-medium [&>tr]:last:border-b-0'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})
</script>
