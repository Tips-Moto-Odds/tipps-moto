<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import {onMounted, ref, watch} from "vue";
import {debounce} from "lodash";
import {openSideBar} from "@/HelperFunctions/modalControl.js";
import SideLayout from "@/AppComponents/Dashbboard/SideLayout.vue";
import AddAffiliate from "@/Pages/Administrator/Affiliate/Components/AddAffiliate.vue";

const props = defineProps(['affiliates', 'stats', 'search']);

const pageController = useForm({
  search: props.search
});
const usersData = ref(props.affiliates);

// Debounced function to fetch users
const fetchUsers = debounce((value) => {
  pageController.get(route('dashboard.Affiliates.listAffiliates'), {
    preserveScroll: true
  })
}, 1000);

watch(() => pageController.search, (newValue, oldValue) => {
  if (newValue !== oldValue) {
    fetchUsers(newValue);
  }
});

const openAddAffiliatePanel = () => {
  openSideBar();
}

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
  <DashboardLayout page-heading="Affiliate" title="Affiliate">
    <template v-slot:side>
      <SideLayout :title="'Add Affiliate'" @close="openAddAffiliatePanel">
        <AddAffiliate />
      </SideLayout>
    </template>
    <div class="flex gap-3 px-[10px] mb-4">
      <div class="app-panel flex justify-between w-full">
        <div>
          <button @click="openAddAffiliatePanel" class="action-button bg-gray-500 text-white">Add Affiliate</button>
        </div>
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
          <h4>All Affiliate</h4>
          <FilterSection/>
        </div>
        <div>
          <table class="text-white w-full mb-[20px] table-sm">
            <thead class="h-[50px] ">
            <tr class="text-left border-b-[2px] text-xs">
              <th v-if="false"></th>
              <th class="text-center w-[80px]">ID</th>
              <th class="">User</th>
              <th class="">Referrals</th>
              <th class="">Total Earnings</th>
              <th class="">Withdrawn Amount</th>
              <th>Referral Code</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="(user, index) in affiliates.data" :key="user.id">
              <Link :href="route('dashboard.user.viewUsers', [user.id])" as="tr">
                <td v-if="false" class="w-[100px]" @click.stop>
                  <input class="text-blue-600" type="checkbox"/>
                </td>
                <td class="text-center">{{ user.id }}</td>
                <td>
                  <p class="mb-[5px]">{{ user.name }}</p>
                  <p class="mb-[5px] text-xs text-gray-400">{{ user.email }}</p>
                </td>
                <td>{{ user.affiliate.total_referrals }}</td>
                <td>{{ user.earned }}</td>
                <td>{{ user.affiliate.withdrawn_amount }}</td>
                <td>{{ user.affiliate.referral_code }}</td>
              </Link>
            </template>
            </tbody>
          </table>
          <div v-if="false">
            <Pagination :pagination="affiliates.links"/>
          </div>
        </div>
      </div>
      <div v-if="false" class="w-4/12">
        <div class="app-panel">
          <div class="app-panel-heading">
            <h4>Summary</h4>
          </div>
          <div class="list-display text-white">
            <ul>
              <li class="flex justify-between items-center">
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
