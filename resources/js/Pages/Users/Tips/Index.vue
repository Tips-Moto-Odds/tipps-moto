<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import Pagination from "@/AppComponents/Global/Pagination.vue";
import {Link, usePage} from "@inertiajs/vue3"
import FilterSection from "@/AppComponents/Dashbboard/FilterSection.vue";
import SubscriptionDetails from "@/Pages/Users/Tips/Componsnets/SubscriptionDetails.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import UserAaccountNavigation from "@/AppComponents/Users/UserAaccountNavigation.vue";

const props = defineProps(['tips', 'user_data'])
const page = usePage()
const accountType = page.props.account_type


</script>

<template>

  <HomeLayout>
    <div class="container h-[80px] p-2 flex justify-between items-center">
      <h1 class="text-xl text-white">Tips</h1>
      <div class="hidden md:flex">
        <Link as="button" class="btn btn-primary text-white bg-orange-600 px-[10px] rounded-sm py-1" href="/logout" method="POST" @click.prevent="">Log Out</Link>
      </div>
    </div>
    <section class="container flex mb-[50px]">
      <UserAaccountNavigation/>

      <section class="w-full">
        <SubscriptionDetails :user_data/>
        <div class="flex gap-3 px-[10px]">
          <div v-if="tips" class="app-panel w-full">
            <div class="app-panel-heading flex justify-between items-center">
              <h1>All Tips</h1>
              <FilterSection v-if="accountType === 'Administrator' || accountType === 'Manager'"/>
            </div>
            <table class="text-white w-full mb-[20px]">
              <thead class="h-[50px]">
                <tr class="text-left border-b-[2px] text-xs">
                  <th v-if="accountType === 'Administrator'|| accountType === 'Manager'" class="text-center">ID
                  </th>
                  <th class="md:table-cell">Date</th>
                  <th>Teams</th>
                  <th class="hidden md:table-cell">Odds</th>
                  <th class="">Prediction</th>
                  <th class="hidden md:table-cell">Status</th>
                  <th class="hidden md:table-cell">Wining Status</th>
                  <th v-if="accountType === 'Administrator' || accountType === 'Manager'" class="text-center">
                    Action
                  </th>
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
                    <p v-if="tip.winning_status == 1" class="text-green-500">Won</p>
                    <p v-else-if="tip.winning_status == 0" class="text-red-500">Lost</p>
                    <p v-else class="text-orange-400">N/A</p>
                  </td>
                  <td v-if="accountType === 'Administrator' || accountType === 'Manager'">
                    <danger-button>Delete</danger-button>
                  </td>
                </Link>
              </tbody>
            </table>
            <div>
              <Pagination :pagination="tips.links"/>
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
      </section>
    </section>
  </HomeLayout>


</template>

<style lang="scss">
table {
  tbody {
    tr {
      border-bottom: 2px solid gray;
      @apply rounded-sm overflow-hidden text-xs;

      td {
        vertical-align: top;
        @apply pt-[10px];
      }

      &:hover {
        cursor: pointer;
        background-color: #575454;
      }
    }
  }
}

</style>
