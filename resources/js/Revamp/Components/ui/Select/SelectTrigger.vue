<template>
    <button
        :class="triggerClasses"
        @click="toggleOpen"
        type="button"
        role="combobox"
        :aria-expanded="isOpen"
    >
        <slot/>
        <ChevronDown class="h-4 w-4 opacity-50"/>
    </button>
</template>

<script setup>
import {ChevronDown} from 'lucide-vue-next'
import {inject, computed} from 'vue'

const props = defineProps({class: String})

const selectContext = inject('selectContext')
const isOpen = selectContext?.isOpen

const toggleOpen = () => {
    if (isOpen) isOpen.value = !isOpen.value
}

const triggerClasses = computed(() => {
    const base = 'flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50'
    return props.class ? `${base} ${props.class}` : base
})
</script>
