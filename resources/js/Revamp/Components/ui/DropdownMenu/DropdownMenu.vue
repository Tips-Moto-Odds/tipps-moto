<template>
    <div class="relative inline-block">
        <slot/>
    </div>
</template>

<script setup>
import {provide, ref} from 'vue'

const isOpen = ref(false)

const toggleOpen = () => {
    isOpen.value = !isOpen.value
}

const closeMenu = () => {
    isOpen.value = false
}

provide('dropdownContext', {
    isOpen,
    toggleOpen,
    closeMenu
})
</script>
