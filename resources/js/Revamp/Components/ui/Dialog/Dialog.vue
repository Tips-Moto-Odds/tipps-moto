<template>
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center">
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-black/50 backdrop-blur-sm"
            @click="$emit('update:open', false)"
        ></div>

        <!-- Dialog Content -->
        <DialogContent :class="contentClass">
            <slot/>
        </DialogContent>
    </div>
</template>

<script setup>
import DialogContent from './DialogContent.vue'

const props = defineProps({
    open: Boolean,
    contentClass: String
})

defineEmits(['update:open'])
</script>
