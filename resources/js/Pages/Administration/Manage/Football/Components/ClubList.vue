<script setup>

import {debounce} from "lodash";
import {ref} from "vue";

const searchParam = ref('')

const emit = defineEmits(['handleSearch','selectTeam'])

defineProps({
    clubs:Object,
})

function selectTeam(team){
    emit('selectTeam',team)
}

const debouncedSubmit = debounce(() => {
    emit("handleSearch",searchParam.value)
}, 500)

</script>
<template>
  <div class="app-panel w-[300px] h-[80vh] overflow-auto">
    <div class="app-panel-heading">
      <h1>List</h1>
    </div>
    <div class="mb-[10px] text-gray-500">
      <input v-model="searchParam" class="rounded-lg h-[30px] w-full" placeholder="Search..." @keyup="debouncedSubmit">
    </div>
    <table class="!text-lg">
      <tbody>
      <tr v-for="club in clubs" @click.prevent.stop="selectTeam(club.id)" :key="club.id">
        <td class="w-[80px]">
          <div
              class="w-[50px] h-[50px] p-[1px] bg-white flex items-center justify-center mb-[10px] rounded-lg overflow-hidden">
            <img style="object-fit: contain; object-position: center; width: 100%; height: 100%;"
                 :src="'/storage/System/TeamLogos/'+club.logo" alt="logo">
          </div>
        </td>
        <td class="align-middle">{{club.name}}</td>
        <td>{{club.tags}}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
