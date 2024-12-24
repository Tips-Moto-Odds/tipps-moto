<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    pagination: Object
})
</script>

<template>
    <nav class="py-[10px] flex gap-2.5 rounded-sm">
        <template  v-for="link in pagination" :key="link.label">
            <Link v-if="link.url" :href="link.url"  v-html="link.label"
                  class="text-white  px-[8px] py-[5px] hover:bg-gray-500"
                  :class="{'bg-gray-500':link.active}"
            />
        </template>
    </nav>
</template>

<style scoped lang="scss">
a{
    text-decoration: none;
}
</style>
