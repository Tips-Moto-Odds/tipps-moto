<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
</script>

<template>
    <DashboardLayout title="FootBall" page-heading="Teams">
        <div class="w-[98%] mx-auto text-white flex gap-3" >
            <div class="app-panel w-1/2">
                <div class="app-panel-heading">
                    <h1>List</h1>
                </div>
                <table class="!text-lg">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>

                        </td>
                        <td>Manchester City</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="app-panel w-1/2">
                <div class="app-panel-heading">
                    <h1>Add Team</h1>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped lang="scss">

</style>
