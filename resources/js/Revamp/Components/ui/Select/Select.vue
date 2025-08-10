<template>
    <div class="relative">
        <slot/>
    </div>
</template>

<script setup>
import {provide, ref} from 'vue'

const selectedValue = ref('')
const isOpen = ref(false)

const updateValue = (value) => {
    selectedValue.value = value
    isOpen.value = false
}

provide('selectContext', {
    selectedValue,
    isOpen,
    updateValue,
})
</script>
