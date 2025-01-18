<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {useAccountStore} from "@/Stores/AccountControl.js";
import {useForm} from "@inertiajs/vue3";

const props = defineProps(['user','can_log_in_as_user'])
const AdminStore = useAccountStore()
const userForm = useForm(props.user)


function formatDate(dateTimeString) {
  const date = new Date(dateTimeString);
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${month}-${day}-${year}`;
}

function formatTime(dateTimeString) {
  const date = new Date(dateTimeString);
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  return `${hours}:${minutes}`;
}


const updateUser = () => {
}
const deleteUser = () => {
  // Prompt the user for confirmation
  if (window.confirm("Are you sure you want to delete this user?")) {
    userForm.delete(route('DeleteUsers',[userForm.id]), {
      onSuccess: () => {
        alert("User deleted successfully!");
      },
      onError: () => {
        alert("There was an error deleting the user.");
      }
    });
  }
};


const updateAdminMode = () => {
  AdminStore.enableAdminMode()
}

</script>


<template>
  <DashboardLayout page-heading="View User" title="View User">
    <div class="app-panel flex justify-between mx-[20px] !py-[20px]">
      <div class="w-[150px] h-[150px] bg-gray-500 rounded flex items-center justify-center">
        <i class="bi bi-person-fill text-white text-[100px]"></i>
      </div>
      <div class="h-[150px] flex-grow-[1] px-[30px] flex flex-col justify-center">
        <h2 class="font-bold text-white text-[22px]">{{ user.name }}</h2>
        <ul class="text-white text-sm">
          <li class="flex py-[5px]"><p class=" w-[100px] flex justify-between">Role <span class="text-right">:</span>
          </p>
            <p class="px-[10px]">{{ user.role_name }}</p></li>
          <li class="flex py-[5px]"><p class=" w-[100px] flex justify-between">Email <span class="text-right">:</span>
          </p>
            <p class="px-[10px]">{{ user.email }}</p></li>
          <li class="flex py-[5px]"><p class=" w-[100px] flex justify-between">Phone <span class="text-right">:</span>
          </p>
            <p class="px-[10px]">{{ user.phone }}</p></li>
          <li class="flex py-[5px]"><p class=" w-[100px] flex justify-between">Status <span class="text-right">:</span>
          </p>
            <p class="px-[10px] mx-[10px] rounded-sm bg-green-500">{{ user.status }}</p></li>
        </ul>
      </div>
      <div class="w-[200px]">
        <div class="flex flex-col gap-[10px]">
          <button class="action-button bg-blue-500 text-white text-sm" @click="updateUser">Update</button>
          <button class="action-button bg-red-500 text-white text-sm" @click="deleteUser">Delete</button>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<style lang="scss" scoped>
.action-button {
  @apply px-[10px] py-[5px] rounded-sm;
}

.side-section {
  @apply p-2 rounded;

  & > h1 {
    @apply text-[25px] font-light mb-[20px]
  }

  & > ul {
    @apply px-[10px];
    & > li {
      @apply flex justify-between mb-[10px];

      ul {
        @apply flex items-center gap-5;

        li {
          @apply text-sm w-[20px] h-[20px] text-center rounded-[50%];
        }

        li.win {
          @apply bg-green-500;
        }

        li.draw {
          @apply bg-orange-500;
        }

        li.lost {
          @apply bg-red-500;
        }
      }
    }
  }
}

</style>
