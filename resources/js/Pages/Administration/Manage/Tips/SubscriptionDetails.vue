<script setup>
function subscribeToTips(){
    console.log()
}
</script>
<template>
  <div class="flex gap-3 px-[10px] pan">
    <div class="app-panel w-full">
        <div class="app-panel-heading flex justify-between items-center">
            <h1>Subscription</h1>
        </div>
        <ul class="text-sm text-white m-[15px]">
            <li>
                <p>Subscription:</p>
                <p>N/A</p>
            </li>
            <li>
                <p>Time Remaining</p>
                <p>N/A</p>
            </li>
            <li>
                <p>Status</p>
                <p>Inactive</p>
            </li>
        </ul>
        <div class="md:w-[300px] md:float-end">
            <button class="bg-green-500" @click="subscribeToTips">Subscribe</button>
            <button class="bg-red-400">Unsubscribe</button>
        </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.pan{
    @apply text-white;

    ul {
        li{
            @apply flex justify-between mb-[10px];
        }
    }

    div{
        button{
            @apply block w-full mb-[10px] rounded py-[8px];
        }
    }
}


</style>
<script setup lang="ts">
</script>
