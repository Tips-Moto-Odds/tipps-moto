<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {searchUserByID} from "@/Pages/Administrator/Affiliate/Actions.js";
import {debounce} from "lodash";
import {ref} from "vue";


const userList = ref([

])

const searchUserTerm = ref("");

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

    console.log(userList.value);
}, 500);
</script>
<template>
    <div class="bg-gray-800 p-[20px] w-full h-[500px] rounded">
        <input-label class="text-white">User ID</input-label>
        <TextInput v-model="searchUserTerm" @input="debounceSendData" class="block mb-4 w-full"></TextInput>
        <div class="text-white" v-if="userList.length">
            <h6>Users</h6>
            <ul class="text-white pl-[10px]">
                <li v-for="item in userList">
                    <div class="bg-gray-600 rounded mb-2 p-2">
                        <p>{{item.name}}</p>
                        <p class="text-sm text-gray-900">{{item.email}}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
