<script setup>
import PageHeading from "@/Pages/Home/components/PageHeading.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import {ref} from "vue";

const form = useForm({
    code: '',
    email: '',
    password: 'password',
    password_confirmation: 'password'
});


const credentials = useForm({
    email: 'kimmwaus@gmail.com',
    phone: '+245719445697'
});

const show_code_display = ref(false)

function verifyPhoneNumber() {
    axios.post(route('validatePhoneNumber',
        credentials
    )).then((resp) => {
        //TODO:remove this line
        console.log(resp.data['code'])

        if (resp.data.status) {
            //TODO:Activate this line
            // alert("The reset token has been sent to our phone number")

            show_code_display.value = true;
            form.code = resp.data['code'].toString()
            form.email = credentials.email
        }

    }).catch((error) => {
        if (error.response.status === 400) {
            alert(error.response.data.error)
        }
    });
}

function reset_password() {
    form.post(route('changePassword'), {
        onSuccess: () => {
            //reset form
            form.reset()
            alert('Password changed successfully')
        }
    })
}

</script>

<template>
    <HomeLayout>
        <div class="h-[140px] mb-[40px] banner">
            <page-heading title="Confirm Code"/>
        </div>
        <div class="container px-[20px]">
            <div class="content max-w-[500px] mx-auto rounded overflow-hidden shadow">
                <div class="app-card">
                    <form @submit.prevent.stop="verifyPhoneNumber">
                        <p>Please enter your registered phone number and email</p>
                        <div>
                            <label>Email</label>
                            <TextInput
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocompletes
                                v-model="credentials.email"
                            />
                            <InputError class="mt-2" :message="form.errors.code"/>
                        </div>
                        <div>
                            <label>Phone Number</label>
                            <TextInput
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocompletes
                                placeholder="+2547*********"
                                v-model="credentials.phone"
                            />
                            <InputError class="mt-2" :message="form.errors.code"/>
                        </div>
                        <button class="mb-[20px]">Confirm Account Details</button>
                    </form>
                </div>
            </div>
        </div>
        <div v-show="show_code_display" class="container px-[20px]">
            <div class="content max-w-[500px] mx-auto rounded overflow-hidden shadow">
                <div class="app-card">
                    <form @submit.prevent.stop="reset_password">
                        <p>Please enter the code sent to the phone above</p>
                        <p class="mb-[20px]">
                            If you did not receive the code please contact us at
                            <a class="text-orange-400 underline"
                               href="mailto:support@example.com">support@example.com</a>.
                        </p>
                        <div>
                            <label>Code</label>
                            <TextInput
                                v-model="form.code"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocompletes
                            />
                            <InputError class="mt-2" :message="form.errors.code"/>
                        </div>
                        <div>
                            <label>New Password</label>
                            <TextInput
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocompletes
                            />
                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <TextInput
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocompletes
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>
                        <button class="mb-[20px]">Change Password</button>
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
        bg-gray-600  w-full text-white rounded-sm shadow
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
                        width: 50px;
                        height: 50px;
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
