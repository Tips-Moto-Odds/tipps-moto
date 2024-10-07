<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, usePage} from "@inertiajs/vue3"
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import TableActionButtons from "@/AppComponents/Dashbboard/TableActionButtons.vue";

const props = defineProps(['users'])
const page = usePage()
const accountType = page.props.account_type

const openDeleteConfirmation = (id) => {
  console.log(id)
}

</script>

<template>
  <DashboardLayout page-heading="Accounts" title="Accounts">
    <div class="flex gap-3 px-[10px]">
      <div class="app-panel w-full">
        <div class="app-panel-heading flex justify-between items-center">
          <h1>All Accounts</h1>
          <FilterSection v-if="accountType === 'Administrator' || accountType === 'Moderator'"/>
        </div>
        <div>
          <table class="text-white w-full mb-[20px]">
            <thead class="h-[50px]">
              <tr class="text-left border-b-[2px] text-xs">
                <th class="text-center w-[50px]">#</th>
                <th class="text-center w-[100px]">ID</th>
                <th class="md:table-cell">User</th>
                <th class="md:table-cell">Email</th>
                <th class="md:table-cell">Phone Number</th>
                <th class="md:table-cell text-center">Role</th>
                <th class="md:table-cell text-right">Date Joined</th>
                <th class="md:table-cell text-center w-[120px]">Action</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="(user,index) in users.data">
                <Link :href="route('ViewAccounts',[user.id])" as="tr" class="border-b  text-xs">
                  <td class="text-center w-[50px]">{{ index + 1 }}</td>
                  <td class="text-center w-[100px]">{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.phone }}</td>
                  <td class="text-center">{{ user.role_name }}</td>
                  <td class="text-right">
                    {{
                      new Date(user.created_at).toLocaleString('en-GB', {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                      }).replace(',', '')
                    }}
                  </td>
                  <td>
                    <TableActionButtons :id="user.id" @deleteModel="openDeleteConfirmation"></TableActionButtons>
                  </td>
                </Link>
              </template>
            </tbody>
          </table>
          <div>
            <Pagination :pagination="users.links"/>
          </div>
        </div>

      </div>
      <div v-if="false" class="w-4/12">
        <div class="app-panel">
          <div class="app-panel-heading">
            <h1>All Time Summary</h1>
          </div>
          <div class="list-display">
            <ul class="">
              <li><p>Total Tips</p>
                <p>-</p></li>
              <li><p>Future</p>
                <p>-</p></li>
              <li><p>Current</p>
                <p>-</p></li>
              <li><p>Past</p>
                <p>-</p></li>
            </ul>
            <hr>
            <ul>
              <li><p>Total Wins</p>
                <p>-</p></li>
              <li><p>Total Losses</p>
                <p>-</p></li>
              <li><p>Win Percentage</p>
                <p>-</p></li>
            </ul>
          </div>
        </div>
        <div class="app-panel">
          <div class="app-panel-heading">
            <h1>Daily Summary</h1>
          </div>
          <div class="list-display">
            <ul>
              <li><p>Tips Sold</p>
                <p>-</p></li>
              <li><p>Winning Accuracy</p>
                <p>-</p></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
