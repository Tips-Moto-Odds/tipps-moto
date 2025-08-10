<template>
    <div :class="itemClasses" @click="handleClick" role="menuitem">
        <slot/>
    </div>
</template>

<script setup>
import {inject, computed} from 'vue'

const props = defineProps({
    class: String,
    disabled: Boolean
})

const emit = defineEmits(['click'])
const {closeMenu} = inject('dropdownContext')

const itemClasses = computed(() => {
    const base = 'relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground'
    const hover = props.disabled ? 'pointer-events-none opacity-50' : 'hover:bg-accent hover:text-accent-foreground'
    return props.class ? `${base} ${hover} ${props.class}` : `${base} ${hover}`
})

const handleClick = () => {
    if (!props.disabled) {
        emit('click')
        closeMenu()
    }
}
</script>
