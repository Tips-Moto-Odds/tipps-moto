<script setup>

const props = defineProps(['active_tip','userForm'])
const emit = defineEmits(['closeSideBar','initiateTransaction'])

function initiateTransaction(){
    emit('initiateTransaction')
}

</script>

<template>
  <div v-if="active_tip != null" class="w-full h-full relative p-[10px] bg-[#4B4949] shadow-xl">
    <div class="flex justify-between mb-[20px]">
      <h1 class="text-[28px] text-white">Creating Order</h1>
      <div>
        <button class="px-[3px] py-[5px] rounded" @click="() => emit('closeSideBar')">
          <img width="30" height="30" src="https://img.icons8.com/ios/50/ffffff/delete-sign--v1.png" alt="delete-sign--v1"/>
        </button>
      </div>
    </div>
    <p class="text-white px-[10px] mb-[30px]">Enter M-Pesa phone number to complete placing tip order for:<br/>
      Match ID <span class="text-orange-200 underline">{{active_tip.id}}</span><br>
      <span class="text-orange-200 underline">{{active_tip.home_teams}}</span> vs
      <span class="text-orange-200 underline">{{active_tip.away_teams}}</span>
    </p>
    <div class="flex flex-col px-[10px]">
      <label class="text-white mb-[10px]">Mpesa Phone Number</label>
      <input class="rounded" v-model="userForm.user_number" >
    </div>
    <div class="absolute w-[calc(100%_-_20px)] flex items-center justify-between" style="top :90%">
      <button class="px-[20px] bg-green-600 text-white py-[10px] rounded" @click.prevent.stop="initiateTransaction">Confirm</button>
      <button class="px-[20px] bg-red-400 text-white py-[10px] rounded" >Cancel</button>
    </div>
  </div>
</template>
