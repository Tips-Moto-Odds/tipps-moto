<script setup>
import {Head} from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";
</script>

<template>
    <Head>
        <title>FAQs</title>
    </Head>
    <Navigation/>
    <div class="container md:flex md:gap-2.5">
        <div class="container text-white text-sm bg-gray-500] px-[20px]">
            <div class="text-white mb-[30px]">
                <h1>Frequently asked questions(FAQs)</h1>
            </div>
            <div class="content" v-for="item in 5">
                <h4 class="mb-[20px] font-bold text-[22px]">WHO WE ARE</h4>
                <p>At Tips Moto, we are more than just a sports betting tips service; we are a dedicated community
                    of sports enthusiasts and betting professionals committed to your success. Our team is composed
                    of seasoned analysts and statistical experts who share a deep understanding of the game.
                    .</p>
                <hr>
            </div>
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
