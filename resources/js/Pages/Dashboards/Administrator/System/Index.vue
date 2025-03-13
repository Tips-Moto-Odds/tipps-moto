<script setup>

import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {ref} from "vue";
import Subscriptions from "@/Pages/UserPanel/Subscriptions.vue";

const ActionResponse = ref('')
const syncData = (model) => {
    axios.post(route('dashboard.system.syncData'),{
        'model':model
    }).then((resp) => {
        ActionResponse.value = ActionResponse.value+'<br>'+'<p class="text-green-500">'+resp.data.message+'</p>'
    }).catch((error) => {
        ActionResponse.value = ActionResponse.value+'<br>'+'<p class="text-red-500">'+error+'</p>'
    })
}
</script>

<template>
    <DashboardLayout page-heading="System" title="System">
        <section class="sync-section app-panel w-[98%] rounded mx-auto p-[20px]">
            <div class="app-panel-heading">
                <h5 class="text-white">Sysc</h5>
            </div>
            <section class="flex gap-3">
                <div class="!w-[600px] mb-[10px]">
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
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Matches')">Sync</button>
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
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Tips')">Sync</button>
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
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Selection')">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Transactions</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Transactions')">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-[30px]">
                                <p class="p-[20px]">Subscriptions</p>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2 text-sm">
                                    <button class="btn btn-primary w-auto" @click.prevent="syncData('Subscriptions')">Sync</button>
                                    <button class="btn btn-danger w-auto">Truncate</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class=" w-full text-white">
                    <h2 class="mb-[20px]">Response</h2>
                    <div class="bg-black rounded h-[calc(100%_-_60px)] p-[5px] " v-html="ActionResponse"></div>
                </div>
            </section>
        </section>
    </DashboardLayout>
</template>

<style lang="scss">
.sync-section {

}
</style>
