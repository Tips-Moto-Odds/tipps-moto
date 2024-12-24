<script setup>
const props = defineProps(['tip'])
const emit = defineEmits(['update:tip'])

function deleteTip(id) {
    axios.delete(route('dashboard.tips.deleteTips', [id]))
        .then((response) => {
            window.location.reload();
        }).catch((error) => {
        console.log(error);
    })
}
</script>
<template>
    <div class="bg-gray-600 w-100 p-[10px] flex flex-column  rounded mb-[10px]">
        <h4 class="text-center mb-[20px]">{{ tip.predictions }}</h4>
        <ul class="flex justify-between px-[10px] m-0">
            <li>Tip Type</li>
            <li>{{ tip.prediction_type }}</li>
        </ul>
        <hr>
        <ul class="flex justify-between px-[10px] m-0">
            <li>Risk Level</li>
            <li>{{ tip.prediction_confidence }}</li>
        </ul>
        <hr>
        <ul class="flex justify-between px-[10px] m-0">
            <li>Free</li>
            <li>{{ tip.mark_as_free == '1'?"Yes":"No" }}</li>
        </ul>
        <ul v-if="!tip.winning_status == 'Pending'" class="flex justify-between px-[10px] pb-[10px] m-0">
            <li>Win Status</li>
            <li>{{ tip.winning_status }}</li>
        </ul>
        <div class="pt-[20px] flex justify-between px-[10px] m-0">
            <button class="action-button px-2 py-1 bg-blue-500 hover:bg-blue-500/50 " @click.prevent="emit('update:tip', tip)">Edit</button>
            <button class="action-button px-2 py-1 bg-red-500 hover:bg-red-500/50 " @click.prevent="deleteTip(tip.id)">Delete</button>
        </div>
    </div>
</template>
<style lang="scss" scoped>
.action-button {
    @apply px-[10px] py-[8px] rounded-sm;
}

</style>
