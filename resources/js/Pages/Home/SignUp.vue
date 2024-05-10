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
    name: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const handleOpening = () => $("#main-site-menu").css('right', '100%')
const handelClosing = () => $('#main-site-menu').css('right', '0%')

function register() {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
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
        <div class="content ">
            <div class="app-card  max-w-[500px] mx-auto rounded overflow-hidden shadow">
                <form @submit.prevent.stop="register">
                    <div>
                        <label>Username</label>
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="name"
                        />
                    </div>
                    <div>
                        <label>Phone</label>
                        <TextInput
                            id="phone"
                            v-model="form.phone"
                            type="tel"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocompletes
                        />
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
                    </div>
                    <div>
                        <label>Confirm Password</label>
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="terms">
                            <div class="flex items-center">
                                <Checkbox id="terms" v-model:checked="form.terms" name="terms"
                                          class="!w-[20px] !h-[20px] mr-[20px] " required/>
                                <p class="text-sm text-white !font-extralight">By creating an account you agree to our
                                    Terms and
                                    Condition</p>
                            </div>
                            <InputError class="mt-2" :message="form.errors.terms"/>
                        </InputLabel>
                    </div>
                    <button class="mb-[20px]">Sign Up</button>
                    <p>Already have an account? <Link :href="route('sign-in')" class="text-orange-400 underline">Sign In</Link> </p>
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
