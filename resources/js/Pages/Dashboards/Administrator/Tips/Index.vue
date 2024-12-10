<script setup>
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3"
import {closeSideBar} from "@/HelperFunctions/modalControl.js";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import {watch} from "vue";
import {debounce} from "lodash";

const props = defineProps(['tips', 'user_data', 'search'])
const page = usePage()
const accountType = page.props.account_type
const pageController = useForm({
  search: props.search
});

// Debounced function to fetch users
const fetchUsers = debounce((value) => {
  pageController.get(route('dashboard.tips.listTips'), {
    preserveScroll: true
  })
}, 1000);

watch(() => pageController.search, (newValue, oldValue) => {
  if (newValue !== oldValue) {
    fetchUsers(newValue);
  }
});


</script>

<template>
  <DashboardLayout page-heading="Tips" title="Tips">
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
    <template v-slot:side>
      <div class="right-panel fixed closed">
        <div class="w-full h-full p-[10px] bg-gray-700 shadow-xl">
          <div class="flex justify-between">
            <h1 class="text-2xl text-white">Filter Tips</h1>
            <div>
              <button class="bg-red-400 text-white px-[3px] py-[5px] rounded" @click="closeSideBar">Close</button>
            </div>
          </div>
        </div>
      </div>
    </template>
    <div class="flex gap-3 px-[10px]">
      <div v-if="tips && tips.data.length > 0" class="app-panel w-full">
        <div class="app-panel-heading flex justify-between items-center">
          <h1>All Tips</h1>
          <FilterSection v-if="accountType === 'Administrator' || accountType === 'Manager'"/>
        </div>
        <table class="text-white w-full mb-[20px]">
          <thead class="h-[50px]">
            <tr class="text-left border-b-[2px] text-xs">
              <th v-if="accountType === 'Administrator'|| accountType === 'Manager'" class="text-center">ID</th>
              <th class="md:table-cell">Date</th>
              <th>Teams</th>
              <th class="hidden md:table-cell">Odds</th>
              <th class="">Prediction</th>
              <th class="hidden md:table-cell">Status</th>
              <th class="hidden md:table-cell text-center">Wining Status</th>
            </tr>
          </thead>
          <tbody>
            <Link v-for="tip in tips.data" :href="route('viewTip',[tip.id])" as="tr"
                  class="border-b h-[70px] text-xs">
              <td v-if="accountType === 'Administrator' || accountType === 'Manager'"
                  class="w-[50px] text-center">{{ tip.id }}
              </td>
              <td class="w-[100px]">{{ tip.match_start_time }}</td>
              <td>
                <div class="h-full w-full">
                  <p class="">Home : {{ tip.home_teams }}</p>
                  <p class="">Away : {{ tip.away_teams }}</p>
                </div>
              </td>
              <td class="hidden md:table-cell">
                <div class="h-full w-full">
                  <p><span class="w-[80px] mr-[10px]">Home Odd:</span> {{ tip.home_odds }}</p>
                  <p><span class="w-[80px] mr-[10px]">Draw Odd:</span> {{ tip.draw_odds }}</p>
                  <p><span class="w-[80px] mr-[10px]">Away Odd:</span> {{ tip.away_odds }}</p>
                </div>
              </td>
              <td>
                <div class="w-50px">
                  <p class="w-[80px] text-center">{{ tip.predictions == 0 ? 'Draw' : tip.predictions == 1 ? 'Home' : 'Away' }}</p>
                  <p class="w-[80px] text-center">{{ Math.round(tip.predictions_accuracy) }} %</p>
                </div>
              </td>
              <td class="hidden md:table-cell">
                <p>{{ tip.status }}</p>
              </td>
              <td class="text-center hidden md:table-cell">
                <p v-if="tip.winning_status == 'Won'" class="text-green-500">Won</p>
                <p v-else-if="tip.winning_status == 'Lost'" class="text-red-500">Lost</p>
                <p v-else-if="tip.winning_status == 'Undefined'" class="text-orange-400">Undefined</p>
                <p v-else class="text-orange-400">N/A</p>
              </td>
            </Link>
          </tbody>
        </table>
        <div>
          <Pagination :pagination="tips.links"/>
        </div>
      </div>
      <div v-else class="app-panel w-full">
        <div class="flex justify-center items-center h-[300px]">
          <p class="text-[30px] text-white">No results were found</p>
        </div>
      </div>
      <div v-if="tips && (accountType === 'Administrator' || accountType === 'Manager')" class="w-4/12">
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