<template>
    <div :class="avatarClasses">
        <slot/>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    class: String
})

const avatarClasses = computed(() => {
    const base = 'relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full'
    return props.class ? `${base} ${props.class}` : base
})
</script>
