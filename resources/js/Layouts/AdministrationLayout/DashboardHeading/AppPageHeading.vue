<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps(['pageHeading']);
</script>

<template>
    <div>
        <div class="h-[50px] flex justify-between px-[20px] items-center page-header">
            <p class="text-sm text-white">Hello, {{ $page.props.auth.user.name }}</p>
            <div class="flex justify-end gap-2 w-[60%] items-center">
                <input title="Search" type="search" class="h-[30px] rounded bg-gray-500 p-[5px] text-white">
                <div class="">
                    <img class="search right-1 shadow-2xl w-[24px] h-[24px]"
                         src="https://img.icons8.com/ios/50/ffffff/search--v1.png" alt="search--v1"/>
                </div>
            </div>
            <ul class="flex gap-2">
                <Link :as="'li'" title="Home" :href="'/'">
                    <img width="24" height="24"
                         src="https://img.icons8.com/fluency-systems-regular/48/949494/home--v1.png" alt="home--v1"/>
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
