<template>
    <img
        v-if="!imageError"
        :class="imageClasses"
        :src="src"
        :alt="alt"
        @error="handleError"
    />
</template>

<script setup>
import {ref, computed} from 'vue'

const props = defineProps({
    src: String,
    alt: String,
    class: String
})

const imageError = ref(false)

const handleError = () => {
    imageError.value = true
}

const imageClasses = computed(() => {
    const base = 'aspect-square h-full w-full'
    return props.class ? `${base} ${props.class}` : base
})
</script>
