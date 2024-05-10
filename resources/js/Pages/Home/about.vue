<script setup>
import MobilMenu from "@/AppComponents/Mobil-Menu.vue";
import MenuPanel from "@/AppComponents/Menu-panel.vue";
import PageHeading from "@/Pages/Home/PageHeading.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')

</script>

<template>
    <MobilMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobilMenu>
    <menu-panel></menu-panel>
    <div class="h-[140px] mb-[40px] banner">
        <page-heading title="About Us"/>
    </div>
    <div class="container md:flex md:gap-2.5">
        <div class="container text-white text-sm bg-gray-500] px-[20px]">
            <div class="content">
                <h1 class="mb-[20px] font-bold text-[22px]">Who We Are</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis scelerisque condimentum. Sed
                    eu
                    sapien eget diam accumsan varius. Nunc tempor turpis vel purus commodo lobortis. Proin tempus cursus
                    urna,
                    non consectetur velit porttitor vitae. Praesent congue euismod quam, in blandit tortor tincidunt
                    non.
                    Quisque eu vestibulum eros. Nulla luctus, diam vel maximus aliquet, eros odio blandit felis, in
                    vestibulum
                    nisl enim eu justo. Nam odio lorem, malesuada quis nisi quis, lacinia pulvinar lectus. Vestibulum
                    commodo
                    lobortis fermentum.</p>
            </div>
            <div class="content">
                <h1 class="mb-[20px] font-bold text-[22px]">What We Do</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis scelerisque condimentum. Sed
                    eu
                    sapien eget diam accumsan varius. Nunc tempor turpis vel purus commodo lobortis. Proin tempus cursus
                    urna,
                    non consectetur velit porttitor vitae. Praesent congue euismod quam, in blandit tortor tincidunt
                    non.
                    Quisque eu vestibulum eros. Nulla luctus, diam vel maximus aliquet, eros odio blandit felis, in
                    vestibulum
                    nisl enim eu justo. Nam odio lorem, malesuada quis nisi quis, lacinia pulvinar lectus. Vestibulum
                    commodo
                    lobortis fermentum.</p>
            </div>
            <div class="content">
                <h1 class="mb-[20px] font-bold text-[22px]">Why Us</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis scelerisque condimentum. Sed
                    eu
                    sapien eget diam accumsan varius. Nunc tempor turpis vel purus commodo lobortis. Proin tempus cursus
                    urna,
                    non consectetur velit porttitor vitae. Praesent congue euismod quam, in blandit tortor tincidunt
                    non.
                    Quisque eu vestibulum eros. Nulla luctus, diam vel maximus aliquet, eros odio blandit felis, in
                    vestibulum
                    nisl enim eu justo. Nam odio lorem, malesuada quis nisi quis, lacinia pulvinar lectus. Vestibulum
                    commodo
                    lobortis fermentum.</p>
            </div>
        </div>
        <div class="container text-white bg-gray-500] px-[20px] md:w-[500px] mb-[40px]">
            <h1 class="mb-[20px] font-bold text-[22px]">Highlights</h1>
            <ul>
                <li v-for="item in 3" class="mb-[20px]">
                    <div class="bg-gray-600  p-[10px] rounded">
                        <div class="w-full bg-orange-500 h-[200px] rounded">

                        </div>
                        <h2>Fantacy Show: Experts Double Gameweek 35 teams</h2>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <app-footer/>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px];
}


.banner {
    background-image:    url("/storage/app/public/System/banner.png");
    background-size:     cover;
    background-position: center;

    & > div {
        background-color: rgba(0, 0, 0, 0.7);
    }
}

#main-site-menu {
    position:   fixed;
    right:      100%;
    transition: all ease 250ms;

    a {
        @apply py-[20px] px-[50px] mb-[6px] text-white font-semibold
    }

    a.active {
        @apply text-orange-400;
    }
}
</style>
