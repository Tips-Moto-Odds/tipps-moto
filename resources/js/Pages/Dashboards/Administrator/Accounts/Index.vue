<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import TableActionButtons from "@/AppComponents/Dashbboard/TableActionButtons.vue";
import {onMounted, ref, watch} from "vue";
import {debounce} from "lodash";

const props = defineProps([
  'users',
  'stats',
  'search'
]);
const page = usePage();
const pageController = useForm({
  search: props.search
});
const usersData = ref(props.users); // Initialize with props

const accountType = page.props.account_type;

const openDeleteConfirmation = (id) => {
  console.log(id);
};

// Debounced function to fetch users
const fetchUsers = debounce((value) => {
  pageController.get(route('dashboard.user.listUsers'), {
    preserveScroll: true
  })
}, 1000);

watch(() => pageController.search, (newValue, oldValue) => {
  if (newValue !== oldValue) {
    fetchUsers(newValue);
  }
});

onMounted(() => {
  if (props.search != null) {
    //focus on the search
    setTimeout(() => {
      document.getElementById('search').focus();
    }, 100);
  }
})
</script>

<template>
  <DashboardLayout page-heading="Accounts" title="Accounts">
    <div class="flex gap-3 px-[10px] mb-4">
      <div class="app-panel flex justify-between w-full">
        <div></div>
        <div>
          <div>
            <input
                id="search"
                v-model="pageController.search"
                class="rounded-lg"
                placeholder="Search"
                type="search"
            />
          </div>
        </div>
      </div>
    </div>
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
                <th></th>
                <th class="text-center w-[50px]">ID</th>
                <th class="md:table-cell px-[10px]">User</th>
                <th class="md:table-cell">Phone Number</th>
                <th class="md:table-cell text-center">Role</th>
                <th class="md:table-cell text-right px-3">Date Joined</th>
                <th class="md:table-cell text-center w-[120px]">Action</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="(user, index) in usersData.data" :key="user.id">
                <Link :href="route('dashboard.user.viewUsers', [user.id])" as="tr" class="border-b text-xs">
                  <td class="w-[8px]" @click.stop>
                    <input class="text-blue-600" type="checkbox"/>
                  </td>
                  <td class="text-center">{{ user.id }}</td>
                  <td>
                    <p class="mb-[5px]">{{ user.name }}</p>
                    <p>{{ user.email }}</p>
                  </td>
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
                        second: '2-digit',
                      }).replace(',', '')
                    }}
                  </td>
                  <td>
                    <TableActionButtons :id="user.id" @deleteModel="openDeleteConfirmation"/>
                  </td>
                </Link>
              </template>
            </tbody>
          </table>
          <div>
            <Pagination :pagination="usersData.links"/>
          </div>
        </div>
      </div>
      <div class="w-4/12">
        <div class="app-panel">
          <div class="app-panel-heading">
            <h1>Summary</h1>
          </div>
          <div class="list-display">
            <ul>
              <li>
                <p>Total users</p>
                <p>{{ stats.TotalUsers }}</p>
              </li>
            </ul>
            <hr/>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>
