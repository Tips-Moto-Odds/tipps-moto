<script setup>


const props = defineProps(['subscription','displaySubscription'])


function format_days(periods) {
    switch (periods) {
        case 1:
            return "Day"
        case 7:
            return "Week"
        default:
            return ""
    }
}
</script>


<template>
    <li class="price-card shadow-sm md:w-[250px] rounded mb-[10px] px-[10px] pt-[10px] !pb-[40px] text-white">
        <h2 class="text-[25px] font-bold mb-[15px]">{{ subscription.name }}</h2>
        <p class="mb-[15px] text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est molestiae
            necessitatibus</p>
        <h3 class="text-[26px] font-bold mb-[20px]">KSH {{ subscription.price }}
            <span class="text-sm">
                / {{ format_days(subscription.period) }}
            </span>
        </h3>
        <Link v-if="displaySubscription && displaySubscription !== false" class="call-to-action block rounded mb-[20px] py-[8px] text-[18px] text-center"
              :href="route('userSubscribe',[subscription.id])">
            Subscribe
        </Link>
        <p class="mb-[10px] text-[18px]">Includes:</p>
        <ul class="list-disc px-[20px]">
            <li>{{ subscription.tips }} Extra Tips Daily</li>
        </ul>


    </li>
</template>
<style scoped lang="scss">
.price-card {
    background-color: #757575;

    &:hover{
        background-color: darken(#757575,30%);
    }

    .call-to-action {
        @apply bg-orange-400
    }
}
</style>
