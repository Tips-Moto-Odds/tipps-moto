<template>
  <span>
    {{ selectContext?.selectedValue?.value || placeholder }}
  </span>
</template>

<script setup>
import {inject} from 'vue'

const props = defineProps({placeholder: String})
const selectContext = inject('selectContext')
</script>
