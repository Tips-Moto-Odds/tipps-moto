<script setup>
import {Head} from "@inertiajs/vue3";
import AdminDashboardMenu from "@/Layouts/AdministrationLayout/AdminDashboard/AdminDashboardMenu.vue";
import AppPageHeading from "@/Layouts/AdministrationLayout/DashboardHeading/AppPageHeading.vue";

const props = defineProps({
    title: String,
    pageHeading: String,
})
</script>

<template>
    <Head :title="title"/>
    <div class="holder w-full h-[100vh] flex">
        <admin-dashboard-menu/>
        <section class="content-area w-full h-full overflow-auto">
            <slot name="side"></slot>
            <app-page-heading :pageHeading="pageHeading"/>
            <slot></slot>
        </section>
    </div>
</template>

<style scoped lang="scss">

</style>
