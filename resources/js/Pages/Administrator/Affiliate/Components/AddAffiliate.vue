<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {addAffiliate, searchUserByID} from "@/Pages/Administrator/Affiliate/Actions.js";
import {debounce} from "lodash";
import {ref} from "vue";
import {router} from "@inertiajs/vue3";

const userList = ref(null)

const searchUserTerm = ref(null);

// Debounced function
const debounceSendData = debounce(async () => {
  const sanitizedTerm = searchUserTerm.value.trim(); // Remove whitespace

  if (!sanitizedTerm) {
    alert("Search term cannot be empty.");
    return;
  }

  const userID = Number(sanitizedTerm);

  if (isNaN(userID) || userID <= 0) {
    alert("Please enter a valid numeric user ID.");
    return;
  }
  userList.value = await searchUserByID(userID);

}, 500);

const addingAffiliate =  async  () => {
  await addAffiliate(userList.value.id)
  router.reload()
}
</script>
<template>
  <div class="bg-gray-800 p-[20px] w-full h-[500px] rounded">
    <input-label class="text-white">User ID</input-label>
    <TextInput v-model="searchUserTerm" @input="debounceSendData" class="block mb-4 w-full"></TextInput>
    <div class="text-white" v-if="userList !== null">
      <div class="bg-gray-700 rounded p-[20px] w-full" @click.stop="addingAffiliate">
        <p>{{ userList.name }}</p>
        <p class="text-sm text-gray-400">{{ userList.email }}</p>
      </div>
    </div>
  </div>
</template>
