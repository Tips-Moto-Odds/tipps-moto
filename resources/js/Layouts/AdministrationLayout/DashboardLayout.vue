<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import AdminDashboardMenu from "@/Layouts/AdministrationLayout/AdminDashboard/AdminDashboardMenu.vue";
import AppPageHeading from "@/Layouts/AdministrationLayout/DashboardHeading/AppPageHeading.vue";

const props = defineProps({
    title: String,
    pageHeading: String,
})

const page = usePage()
</script>

<template>
    <Head :title="title"/>
    <div class="holder w-full h-[100vh] flex">
        <admin-dashboard-menu id="dashboard-menu" class="absolute left-[-100%] md:block md:static"/>
        <section class="content-area w-full h-full overflow-auto">
            <slot name="side"></slot>
            <app-page-heading :pageHeading="pageHeading"/>
            <slot></slot>
        </section>
    </div>
</template>

<style scoped lang="scss">
#dashboard-menu{
    z-index: 10000;
    background-color: #383838;
    transition: all 0.25s ease-in-out;
}
</style>
