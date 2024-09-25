<script setup>
import { debounce } from 'lodash'

const emit = defineEmits(["searchUser","addUser"])

const props = defineProps([
    'searchForm',
    'searchedUsers'
])

const searchUsers = debounce(async () =>  {
    if (props.searchForm.searchUserText.trim() !== '' && props.searchForm.searchUserText.trim() != null){
        emit('searchUser')
    }
}, 500)

function addUser(id){
    emit('addUser', id)
}
</script>


<template>
  <section>
    <div class=" mb-[10px] flex">
      <input class="h-[35px] rounded-sm mr-[10px] w-full" v-model="props.searchForm.searchUserText" @keyup="searchUsers"/>
      <button class="bg-amber-500 px-[10px] py-[3px] rounded-sm text-white hover:bg-amber-600">Add</button>
    </div>
    <div>
      <ul v-if="props.searchedUsers.length > 0 ">
        <li v-for="item in props.searchedUsers" @click.prevent.stop="addUser(item.id)"
            class="bg-gray-600 mb-[5px] rounded-sm p-[10px] text-white hover:bg-gray-700 cursor-pointer">
          <p>{{item.name}}</p>
          <p>{{item.email}}</p>
        </li>
      </ul>
    </div>
  </section>
</template>
<style scoped lang="scss">
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

form {
  button {
    @apply px-[15px] rounded-sm py-[5px];
  }
}

</style>
