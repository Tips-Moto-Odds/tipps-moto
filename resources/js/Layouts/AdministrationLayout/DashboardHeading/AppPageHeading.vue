<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps(['pageHeading']);


function openMenu() {
    let elem = $("#dashboard-menu")

    elem.css({
        left: "0",
        width: "100%"
    })
}
</script>

<template>
    <div>
        <div class="h-[50px] flex justify-between lg:px-[20px] items-center page-header">
            <button @click="openMenu" type="button" class=" lg:hidden flex items-center justify-center h-full w-[50px] mr-[3px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                </svg>
            </button>
            <p class="text-sm text-white">Hello, {{ $page.props.auth.user.name }}</p>
            <ul class="flex gap-2 items-center m-0 ">
                <Link :as="'li'" title="Home" :href="'/'">
                    <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/949494/home--v1.png" alt="home--v1"/>
                </Link>
                <Link :as="'li'" title="Sign Out" :href="'/logout'" :method="'post'">
                    <img width="20" height="20" src="https://img.icons8.com/ios/50/949494/exit--v1.png" alt="exit--v1"/>
                </Link>
            </ul>
        </div>
        <h1 class="px-[20px] text-[25px] mb-[20px] font-bold text-white">{{ pageHeading }}</h1>
    </div>
</template>
<style scoped lang="scss">
.page-header {
    ul {
        li {
            @apply h-[40px] w-[40px] rounded-[50%] flex items-center justify-center bg-[#363535] shadow-2xl hover:bg-[#474746];
        }
    }
}
</style>
