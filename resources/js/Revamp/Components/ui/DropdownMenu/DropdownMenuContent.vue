<template>
    <div
        v-if="isOpen"
        :class="contentClasses"
        class="absolute top-full right-0 z-50 mt-1 min-w-[8rem]"
        @click.stop
    >
        <slot/>
    </div>
</template>

<script setup>
import {inject, computed, onMounted, onUnmounted} from 'vue'

const props = defineProps({
    align: {
        type: String,
        default: 'end'
    },
    class: String
})

const {isOpen, closeMenu} = inject('dropdownContext')

const contentClasses = computed(() => {
    const base = 'z-50 min-w-[8rem] overflow-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md animate-in data-[state=open]:fade-in-0 data-[state=open]:zoom-in-95'
    return props.class ? `${base} ${props.class}` : base
})

const handleClickOutside = (e) => {
    if (isOpen.value && !e.target.closest('.relative')) closeMenu()
}

onMounted(() => document.addEventListener('click', handleClickOutside))
onUnmounted(() => document.removeEventListener('click', handleClickOutside))
</script>
