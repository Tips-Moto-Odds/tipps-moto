<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import AdminDashboardMenu from "@/Layouts/AdministrationLayout/AdminDashboard/AdminDashboardMenu.vue";
import AppPageHeading from "@/Layouts/AdministrationLayout/DashboardHeading/AppPageHeading.vue";
import {useAccountStore} from "@/Stores/AccountControl.js";

const props = defineProps({
    title: String,
    pageHeading: String,
})

const AdminStore = useAccountStore()

const page = usePage()

const disableAdminMode = () => {
    AdminStore.disableAdminMode();
}
</script>

<template>
    <Head :title="title"/>
    <div class="holder w-full h-[100vh] flex bg-gray-600">
        <AdminDashboardMenu id="dashboard-menu" class="absolute left-[-100%] lg:block lg:static"/>
        <section class="content-area w-full h-full overflow-auto">
            <slot name="side"></slot>
            <app-page-heading :pageHeading="pageHeading"/>
            <slot></slot>
        </section>
    </div>
</template>

<style lang="scss" scoped>
#dashboard-menu {
    z-index: 10000;
    transition: all 0.25s ease-in-out;
    @apply bg-gray-800;
}
</style>
