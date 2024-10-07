<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps(['id'])
const emits = defineEmits(['deleteModel'])

const deleteModel = (id) => {
  emits('deleteModel', id)
}
</script>

<template>
  <div @click.stop class="flex gap-2 w-[160px]">
    <button class="bg-red-600" @click="deleteModel(id)">Delete</button>
    <Link as="button" href="#" class="bg-blue-700">Edit</Link>
  </div>
</template>

<style scoped lang="scss">
button {
  @apply text-white px-[20px] py-[4px] rounded font-bold text-sm flex items-center justify-center
}
</style>