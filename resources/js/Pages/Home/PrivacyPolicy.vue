<script setup>
import MobilMenu from "@/Layouts/HomeLayout/Mobil-Menu.vue";
import MenuPanel from "@/Layouts/HomeLayout/Menu-panel.vue";
import PageHeading from "@/Pages/Home/components/PageHeading.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')

</script>

<template>
    <HomeLayout>
        <div class="h-[140px] mb-[40px] banner">
            <page-heading title="Privacy Policy"/>
        </div>
        <div class="container text-white bg-gray-500] px-[20px]">
            <div class="content">
                <h1 class="mb-[20px] font-bold text-[22px]">Privacy Policy</h1>
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
    </HomeLayout>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px];
}


.banner {
    background-image: url("/System/banner.png");
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
