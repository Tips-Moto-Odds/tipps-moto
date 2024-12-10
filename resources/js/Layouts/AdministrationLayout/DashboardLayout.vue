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
  <teleport to="body">
    <div v-if="AdminStore.canSwitchBackToAdmin" class="w-[120px] h-[40px] rounded fixed bg-purple-600 flex items-center justify-center text-white"
         style="z-index: 50000; bottom: 10px;right: 20px">
      <Link @click="disableAdminMode" as="button" :href="route('admin.return')" >Back to Admin</Link>
    </div>
  </teleport>
  <div class="holder w-full h-[100vh] flex">
    <admin-dashboard-menu id="dashboard-menu" class="absolute left-[-100%] lg:block lg:static"/>
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
  background-color: #383838;
  transition: all 0.25s ease-in-out;
}
</style>
