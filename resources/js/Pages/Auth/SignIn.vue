<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {Link} from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

const form = useForm({
    email: '',
    password: '',
});

console.log(route('login'))

function signIn() {
    form.transform(data => ({
        ...data,
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}

</script>

<template>
    <Navigation/>
    <div class="container mb-[20px] entry-form flex justify-center items-center">
        <form @submit.prevent.stop="signIn">

            <h1>Log In</h1>

            <div>
                <label>Email</label>
                <TextInput v-model="form.email" type="email" class="mt-1 block w-full" required autofocus autocompletes/>
                <InputError class="mt-2" :message="form.errors.email"/>
            </div>

            <div>
                <label>Password</label>
                <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password"/>
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>
            <Link :href="route('reset-password')" class="mb-[10px] block">Forgot Password</Link>
            <button>Sign In</button>
            <p>Don't have an account?
                <Link :href="route('sign-up')" class="text-orange-400 underline">Sign Up</Link>
            </p>

        </form>
    </div>
    <app-footer-main/>
</template>
