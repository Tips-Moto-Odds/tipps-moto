<script setup>

const props = defineProps(['active_tip', 'userForm'])
const emit = defineEmits(['closeSideBar', 'initiateTransaction'])

function initiateTransaction() {
    emit('initiateTransaction')
}

</script>

<template>
    <div v-if="active_tip != null" class="w-full h-full relative p-[10px] bg-[#4B4949] shadow-xl">
        <div class="flex justify-between mb-[20px]">
            <h1 class="text-[28px] text-white">Error</h1>
            <div>
                <button class="px-[3px] py-[5px] rounded" @click="() => emit('closeSideBar')">
                    <img width="30" height="30" src="https://img.icons8.com/ios/50/ffffff/delete-sign--v1.png" alt="delete-sign--v1"/>
                </button>
            </div>
        </div>
        <p class="text-white px-[10px] mb-[30px]">There was a problem processing payment</p>
        <div class="mx-auto bg-red flex justify-center items-center">
            <img class="w-[40px]" src="/storage/System/Icons/icons8-error.gif">
        </div>
    </div>
</template>
