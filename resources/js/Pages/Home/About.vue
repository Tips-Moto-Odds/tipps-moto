<script setup>
import {Head} from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
</script>

<template>
    <Head>
        <title>About Us</title>
    </Head>
    <Navigation/>
    <div class="container bg-black rounded mb-[20px] text-white text-sm bg-gray-500] p-[20px]">
        <div class="content">
            <h1 class="mb-[20px] font-bold text-[22px]">WHO WE ARE</h1>
            <p>At Tips Moto, we are more than just a sports betting tips service; we are a dedicated community
                of sports enthusiasts and betting professionals committed to your success. Our team is composed
                of seasoned analysts and statistical experts who share a deep understanding of the game.
                .</p>
            <hr>
        </div>
        <div class="content">
            <h1 class="mb-[20px] font-bold text-[22px]">WHAT WE DO</h1>
            <p>We understand that every bettor, whether a newcomer or a seasoned pro, seeks clarity and
                accuracy. That’s why we focus on delivering clear, actionable sports betting tips that empower
                you to make well-informed decisions. We meticulously analyzes match statistics, player
                performance, and current trends to bring you the most accurate predictions.
            </p>
            <hr>
        </div>
        <div class="content">
            <h1 class="mb-[20px] font-bold text-[22px]">WHY US</h1>
            <p>Choosing Tips Moto means choosing expertise and reliability. We stand out from the crowd with our
                commitment to providing high-quality, unbiased tips that are backed by thorough rigorous
                research and analysis. Our user-friendly platform ensures that you have access to timely
                information, and our community fosters an engaging environment where you can learn and grow.
                Join us on a path to bigger wins.
                The Odds are in your favor.</p>
        </div>
    </div>
    <app-footer-main/>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px];
}


.banner {
    background-image: url("/storage/app/public/System/banner.png");
    background-size: cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

#main-site-menu {
    position: fixed;
    right: 100%;
    transition: all ease 250ms;

    a {
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active {
        @apply text-orange-400;
    }
}
</style>
