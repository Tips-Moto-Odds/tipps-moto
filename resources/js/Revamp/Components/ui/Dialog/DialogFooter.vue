<template>
    <div :class="footerClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({class: String})

const footerClasses = computed(() => {
    const base = 'flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2 p-6 pt-0'
    return props.class ? `${base} ${props.class}` : base
})
</script>
