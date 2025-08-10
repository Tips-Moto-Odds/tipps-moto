<template>
    <div @click="toggleOpen">
        <slot/>
    </div>
</template>

<script setup>
import {inject} from 'vue'

const {toggleOpen} = inject('dropdownContext')
</script>
