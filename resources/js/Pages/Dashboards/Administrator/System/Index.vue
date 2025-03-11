<script setup>

import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";

const syncData = (model) => {
    axios.post('dashboard.system.syncData').then(() => {
        console.log("done")
    })
        .catch(() => {
            console.log('error')
        })
}
</script>

<template>
    <DashboardLayout page-heading="System" title="System">
        <section class="sync-section app-panel w-[98%] rounded mx-auto h-[500px]  p-[20px]">
            <div class="app-panel-heading">
                <h5 class="text-white">Sysc</h5>
            </div>
            <section class="flex gap-3">
                <div class="w-[400px]">
                    <table class="text-white w-full mb-[20px] table-sm">
                        <thead class="h-[50px] ">
                        <tr class="text-left border-b-[2px] text-xs">
                            <th>Model</th>
                            <th class="w-[150px]">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Accounts</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Accounts')">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Matches</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Tips</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Selection</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class=""></div>
            </section>
        </section>
    </DashboardLayout>
</template>

<style lang="scss">
.sync-section {

}
</style>
