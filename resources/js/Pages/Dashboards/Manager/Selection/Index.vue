<script setup>

import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps(['selections'])
console.log(props.selections)
</script>

<template>
  <DashboardLayout page-heading="Selections" title="Selections">
    <div class="flex gap-3 px-[10px] mb-4">
      <div class="app-panel flex justify-between w-full">
        <div>
            <Link :href="route('dashboard.selection.createSelections')" as="button" class="action-button bg-gray-500 text-white">Add Selection</Link>
        </div>
        <div>
          <div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex gap-3 px-[10px]">
      <div class="app-panel w-full">
        <div class="app-panel-heading flex justify-between items-center">
          <h4>All Selections</h4>
          <FilterSection/>
        </div>
        <div>
          <table v-if="selections.length > 0" class="text-white w-full mb-[20px]">
            <thead class="h-[50px]">
              <tr class="text-left border-b-[2px] text-xs">
                  <th class="p-[10px]">Id</th>
                  <th>Name</th>
                  <th>For</th>
                  <th>Description</th>
                  <th>Tips</th>
                  <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <Link :href="route('dashboard.selection.viewSelections',[selection.id])" as="tr" v-for="selection in selections" class="text-left border-b-[2px] text-xs">
                <td class="p-[10px]">{{selection.id}}</td>
                <td>{{selection.package_name}}</td>
                <td>{{selection.date_for}}</td>
                <td>{{selection.package_description}}</td>
                <td>{{selection.tips_count}}</td>
                <td>{{selection.status?'Active':'Inactive'}}</td>
            </Link>
            </tbody>
          </table>
          <div>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
