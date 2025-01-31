<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

const form = useForm({
    email: '',
    code: '',
    password: '',
    password_confirmation: ''
});


const credentials = useForm({
    email: '',
    phone: ''
});

const show_code_display = ref(false)

function verifyPhoneNumber() {
    axios.post(route('validatePhoneNumber',
        credentials
    )).then((resp) => {
        if (resp.data.status) {
            alert("The reset token has been sent to our Email")

            show_code_display.value = true;
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
            form.reset()
            alert('Password changed successfully')
        }
    })
}

</script>

<template>
    <Navigation/>
    <div class="gap-2 entry-form container mb-[20px] flex flex-col justify-center items-center">
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
            </div>
            <button class="mb-[20px]">Confirm Account Details</button>
        </form>
        <form v-if="show_code_display" @submit.prevent.stop="reset_password">
            <h5>Complete Password Reset</h5>
            <div>
                <label>Email</label>
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocompletes
                    v-model="form.email"
                />
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>
            <div>
                <label>Reset Token</label>
                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocompletes
                    v-model="form.code"
                />
                <InputError class="mt-2" :message="form.errors.code"/>
            </div>
            <div>
                <label>Password</label>
                <TextInput
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocompletes
                    v-model="form.password"
                />
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>
            <div>
                <label>Password Confirmation</label>
                <TextInput
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocompletes
                    v-model="form.password_confirmation"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
            </div>
            <button class="mb-[20px]">Reset Password</button>
        </form>
    </div>
    <app-footer-main/>
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
