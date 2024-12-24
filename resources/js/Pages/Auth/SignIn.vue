<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {Link} from "@inertiajs/vue3";

const form = useForm({
    email: '',
    password: '',
});

function signIn() {
    form.transform(data => ({
        ...data,
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}

</script>

<template>
    <div class=" entry-form bg-black h-[100vh] flex justify-center items-center">
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

            <button>Sign In</button>

            <Link :href="route('reset-password')" class="mb-[10px] block">Forgot Password</Link>

            <p>Don't have an account?<Link :href="route('sign-up')" class="text-orange-400 underline">Sign Up</Link></p>

        </form>
    </div>
</template>
