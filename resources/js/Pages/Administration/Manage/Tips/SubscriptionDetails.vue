<script setup>
import SubscribeForm from "@/Pages/Administration/Manage/Tips/SubscribeForm.vue";
import UnSubscribeForm from "@/Pages/Administration/Manage/Tips/UnSubscribeForm.vue";

const props = defineProps(['user_data'])

const time_remaining = (user_data) => {
    let error;
    try {
        if (!user_data?.subscriptions_details?.start_date || !user_data?.subscriptions_details?.end_date) {
            error =  new Error("Missing start_date or end_date in subscriptions_details")
            throw error;
        }

        const start = new Date(user_data.subscriptions_details.start_date)
        const end = new Date(user_data.subscriptions_details.end_date)

        const diff = end - start

        if (diff <= 0) {
            error = new Error("Invalid date range: end_date must be greater than start_date")
            throw error;
            return;
        }

        return diff / (1000 * 60 * 60 * 24)

    } catch (err) {
        return 'N/A'
    }
}

const subscribeToTips = () => $("#subscription_panel").fadeIn()
const unSubscribe = () => $("#un_subscription_panel").fadeIn()

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
                    <p>{{ user_data.subscriptions_details?.plan ?? 'N/A' }}</p>
                </li>
                <li>
                    <p>Time Remaining</p>
                    <p>{{ time_remaining(user_data) }}</p>
                </li>
                <li>
                    <p>Status</p>
                    <p>{{ user_data.subscriptions_details?.status ?? 'N/A' }}</p>
                </li>
            </ul>
            <div class="md:w-[300px] md:float-end">
                <button v-if="user_data.subscriptions_details" class="bg-red-400" @click.prevent.stop="unSubscribe">Unsubscribe</button>
                <button v-else class="bg-green-500" @click="subscribeToTips">Subscribe</button>

                <teleport to="body">
                    <SubscribeForm class="hidden"/>
                </teleport>
                <teleport to="body">
                    <UnSubscribeForm class="hidden"/>
                </teleport>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
.pan {
    @apply text-white;

    ul {
        li {
            @apply flex justify-between mb-[10px];
        }
    }

    div {
        button {
            @apply block w-full mb-[10px] rounded py-[8px];
        }
    }
}
</style>
