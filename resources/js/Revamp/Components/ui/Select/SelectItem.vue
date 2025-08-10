<template>
    <div
        :class="itemClasses"
        @click="handleSelect"
        role="option"
        :aria-selected="isSelected"
    >
        <slot/>
    </div>
</template>

<script setup>
import {inject, computed} from 'vue'

const props = defineProps({
    value: String,
    class: String,
})

const selectContext = inject('selectContext')

const isSelected = computed(() => selectContext?.selectedValue?.value === props.value)

const itemClasses = computed(() => {
    const base = 'relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50'
    return props.class ? `${base} ${props.class}` : base
})

const handleSelect = () => {
    selectContext?.updateValue?.(props.value)
}
</script>
