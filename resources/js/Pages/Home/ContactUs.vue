<script setup>
import MobilMenu from "@/Layouts/HomeLayout/Components/Mobil-Menu.vue";
import MenuPanel from "@/Layouts/HomeLayout/Components/Menu-panel.vue";
import PageHeading from "@/Pages/Home/components/PageHeading.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import {Head} from "@inertiajs/vue3";

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')

function sendMessage() {
    console.log("sending message")
}

</script>

<template>
    <HomeLayout>
      <Head title="Contact Us" />
        <div class="h-[140px] mb-[40px] banner">
            <page-heading title="Contact Us"/>
        </div>
        <div class="container px-[20px]">
            <h1 class="mb-[20px] font-bold text-[22px] text-white">Reach Out</h1>
            <div class="content text-sm lg:flex lg:gap-2.5">
                <div class="app-card lg:flex lg:w-8/12">
                    <section class="mb-[40px] lg:w-1/2">
                        <h1>Contact Information</h1>
                        <ul>
                            <li>
                                <div></div>
                                <p>company@email.com</p>
                            </li>
                            <li>
                                <div class="self-start"></div>
                                <section>
                                    <ul>
                                        <li>+254 700 000 000</li>
                                        <li>+254 700 000 000</li>
                                        <li>+254 700 000 000</li>
                                    </ul>
                                </section>
                            </li>
                        </ul>
                        <h1>We are Social</h1>
                        <ul>
                            <li>
                                <div></div>
                                <p>tips_moto</p>
                            </li>
                            <li>
                                <div></div>
                                <p>@tipsmoto_ke</p>
                            </li>
                            <li>
                                <div></div>
                                <p>Tipsmoto_ke</p>
                            </li>
                        </ul>
                    </section>
                    <section class="lg:w-1/2">
                        <div class="map w-[100%] h-[300px] bg-white rounded-sm mb-[10px]">

                        </div>
                        <h2>Nairobi CBD</h2>
                        <p>Address info</p>
                    </section>
                </div>
                <div class="app-card ">
                    <p class="mb-6">Send us a message. Our team will get back to you</p>
                    <form @submit.prevent.stop="sendMessage">
                        <div>
                            <label>Email/Phone</label>
                            <input>
                        </div>
                        <div>
                            <label>Subject</label>
                            <input>
                        </div>
                        <div>
                            <label>message</label>
                            <textarea class="lg:h-[100px]"></textarea>
                        </div>
                        <button>Send</button>
                    </form>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>

<style scoped lang="scss">

.content {
    @apply mb-[40px] ;

    .app-card {
        @apply
        bg-gray-700 text-white rounded-sm shadow
        p-[20px] mb-[20px];

        h1 {
            @apply text-[20px] mb-[10px]
        }

        & > section {

            & > ul {
                @apply mb-[20px];

                & > li {
                    @apply flex items-center mb-[10px];

                    div {
                        width: 30px;
                        height: 30px;
                        @apply rounded-sm bg-white mr-[10px];
                    }
                }
            }
        }


        form {
            div {
                @apply mb-[20px];

                label {
                    @apply block mb-[5px]
                }

                input, textarea {
                    color: #2d3748 !important;
                    @apply block w-full rounded;
                }

                textarea {
                    @apply h-[200px];
                }
            }

            button {
                @apply bg-orange-500 w-full py-[10px] rounded;
            }

        }
    }
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
