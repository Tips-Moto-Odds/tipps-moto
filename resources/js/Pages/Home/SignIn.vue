<script setup>
import MobilMenu from "@/AppComponents/Mobil-Menu.vue";
import MenuPanel from "@/AppComponents/Menu-panel.vue";
import PageHeading from "@/Pages/Home/PageHeading.vue";
import AppFooter from "@/Pages/Home/components/AppFooter.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import {Link} from "@inertiajs/vue3";

const form = useForm({
    email: 'admin@email.com',
    password: 'password',
});

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')

function signIn() {
    form.transform(data => ({
        ...data,
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}

</script>

<template>
    <MobilMenu @menu-open="handleOpening" @menu-close="handelClosing"></MobilMenu>
    <menu-panel></menu-panel>
    <div class="h-[140px] mb-[40px] banner">
        <page-heading title="Register"/>
    </div>
    <div class="container px-[20px]">
        <div class="content max-w-[500px] mx-auto rounded overflow-hidden shadow">
            <div class="app-card">
                <form @submit.prevent.stop="signIn">
                    <div>
                        <label>Email</label>
                        <TextInput
                            id="Email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocompletes
                        />
                        <InputError class="mt-2" :message="form.errors.email"/>

                    </div>
                    <div>
                        <label>Password</label>
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password"/>

                    </div>
                    <button class="mb-[20px]">Sign In</button>
                    <p>Don't have an account?
                        <Link :href="route('sign-up')" class="text-orange-400 underline">Sign Up</Link>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <app-footer/>
</template>

<style scoped lang="scss">
.content {
    @apply mb-[40px] ;

    .app-card {
        @apply
        bg-gray-600  w-full text-white rounded-sm shadow
        p-[20px] mb-[20px];

        h1 {@apply text-[20px] mb-[10px] }

        & > section {

            & > ul {
                @apply mb-[20px];

                & > li {
                    @apply flex items-center mb-[10px];

                    div {
                        width:  50px;
                        height: 50px;
                        @apply rounded-sm bg-white mr-[10px];
                    }
                }
            }
        }


        form {
            div {
                @apply mb-[20px];

                label {@apply block mb-[5px] }

                input, textarea {
                    color: #2D3748 !important;
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

<!--                    <div class="flex">-->
<!--                        <div>-->
<!--                            <input class="!w-[20px] !h-[20px] mr-[20px] " type="checkbox" required>-->
<!--                        </div>-->
<!--                        <p class="text-sm !font-extralight">By creating an account you agree to our Terms and-->
<!--                            Condition</p>-->
<!--                    </div>-->
