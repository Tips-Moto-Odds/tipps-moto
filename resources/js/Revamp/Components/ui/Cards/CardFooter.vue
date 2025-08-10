<template>
    <div :class="footerClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const footerClasses = computed(() => {
    const base = 'p-4 pt-0 border-t border-gray-100'
    return props.class ? `${base} ${props.class}` : base
})
</script>
