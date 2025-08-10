<template>
    <div class="relative inline-block">
        <div
            @mouseenter="showTooltip = true"
            @mouseleave="showTooltip = false"
            @focus="showTooltip = true"
            @blur="showTooltip = false"
        >
            <slot name="trigger"/>
        </div>

        <Teleport to="body">
            <div
                v-if="showTooltip"
                :class="tooltipClasses"
                :style="tooltipStyles"
                ref="tooltipRef"
            >
                <slot/>
                <div
                    v-if="showArrow"
                    :class="arrowClasses"
                />
            </div>
        </Teleport>
    </div>
</template>

<script setup>
import {ref, computed} from 'vue'

const props = defineProps({
    side: {
        type: String,
        default: 'top'
    },
    align: {
        type: String,
        default: 'center'
    },
    offset: {
        type: Number,
        default: 4
    },
    showArrow: {
        type: Boolean,
        default: true
    },
    class: String
})

const showTooltip = ref(false)
const tooltipRef = ref(null)

const tooltipClasses = computed(() => {
    const baseClasses = 'absolute z-50 overflow-hidden rounded-md border bg-popover px-3 py-1.5 text-sm text-popover-foreground shadow-md animate-in fade-in-0 zoom-in-95'
    return props.class ? `${baseClasses} ${props.class}` : baseClasses
})

const tooltipStyles = computed(() => {
    const styles = {
        pointerEvents: 'none',
        position: 'absolute'
    }

    switch (props.side) {
        case 'top':
            styles.bottom = '100%'
            styles.left = props.align === 'center' ? '50%' : props.align === 'start' ? '0' : 'auto'
            styles.right = props.align === 'end' ? '0' : 'auto'
            styles.transform = props.align === 'center' ? 'translateX(-50%)' : ''
            styles.marginBottom = `${props.offset}px`
            break
        case 'bottom':
            styles.top = '100%'
            styles.left = props.align === 'center' ? '50%' : props.align === 'start' ? '0' : 'auto'
            styles.right = props.align === 'end' ? '0' : 'auto'
            styles.transform = props.align === 'center' ? 'translateX(-50%)' : ''
            styles.marginTop = `${props.offset}px`
            break
        case 'left':
            styles.right = '100%'
            styles.top = props.align === 'center' ? '50%' : props.align === 'start' ? '0' : 'auto'
            styles.bottom = props.align === 'end' ? '0' : 'auto'
            styles.transform = props.align === 'center' ? 'translateY(-50%)' : ''
            styles.marginRight = `${props.offset}px`
            break
        case 'right':
            styles.left = '100%'
            styles.top = props.align === 'center' ? '50%' : props.align === 'start' ? '0' : 'auto'
            styles.bottom = props.align === 'end' ? '0' : 'auto'
            styles.transform = props.align === 'center' ? 'translateY(-50%)' : ''
            styles.marginLeft = `${props.offset}px`
            break
    }

    return styles
})

const arrowClasses = computed(() => {
    return 'absolute w-2 h-2 bg-popover border transform rotate-45'
})
</script>
