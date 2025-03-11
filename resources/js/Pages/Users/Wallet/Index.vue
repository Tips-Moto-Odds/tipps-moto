<script setup>
import {Link} from "@inertiajs/vue3"
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import UserAaccountNavigation from "@/AppComponents/Users/UserAaccountNavigation.vue";

const props = defineProps(['tips', 'user_data'])


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
        <ul class="w-full gap-1">
          <div class="app-panel w-fit">
            <div class="app-panel-heading flex justify-between items-center">
              <h1>Account Details</h1>
            </div>
            <ul class="text-sm text-white m-[15px]">
              <div class="flex items-center">
                <p class="text-[40px] w-fit p-[10px] rounded">Ksh 80,000</p>
                <div class="border h-[60px] mx-[10px]"></div>
                <div class="h-full flex items-center gap-2">
                  <button class="bg-gray-500 p-[10px] rounded hover:bg-gray-700">Deposit</button>
                  <button class="bg-gray-500 p-[10px] rounded hover:bg-gray-700">Withdraw</button>
                </div>
              </div>
            </ul>
          </div>
          <div class="app-panel w-full">
            <div class="app-panel-heading flex justify-between items-center">
              <h1>Transactions</h1>
            </div>
            <ul class="text-sm text-white m-[15px]">
              <table class="text-white w-full mb-[20px]">
                <thead class="h-[50px]">
                  <tr class="border-b-[2px] text-xs">
                    <th class="md:table-cell">ID</th>
                    <th class="md:table-cell">Action</th>
                    <th class="md:table-cell">Amount</th>
                    <th class="md:table-cell">Date</th>
                    <th class="md:table-cell">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b text-xs">
                    <td>T-000000</td>
                    <td>Deposit</td>
                    <td>Ksh 3000</td>
                    <td>
                      <div><p>00/00/000</p>
                        <p>00:00am</p></div>
                    </td>
                    <td>Completed</td>
                  </tr>
                  <tr class="border-b text-xs">
                    <td>T-000000</td>
                    <td>Withdrawal</td>
                    <td>Ksh 3000</td>
                    <td><p>00/00/000</p>
                      <p>00:00am</p></td>
                    <td>Rejected</td>
                  </tr>
                  <tr class="border-b text-xs">
                    <td>T-000000</td>
                    <td>Deposit</td>
                    <td>Ksh 3000</td>
                    <td>
                      <div><p>00/00/000</p>
                        <p>00:00am</p></div>
                    </td>
                    <td>Pending</td>
                  </tr>
                  <tr class="border-b text-xs">
                    <td>T-000000</td>
                    <td>Deposit</td>
                    <td>Ksh 3000</td>
                    <td>
                      <div><p>00/00/000</p>
                        <p>00:00am</p></div>
                    </td>
                    <td>Completed</td>
                  </tr>
                </tbody>
              </table>
            </ul>
          </div>
        </ul>
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
