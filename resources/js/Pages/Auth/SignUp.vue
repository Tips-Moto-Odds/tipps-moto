<script setup>
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import {Link} from "@inertiajs/vue3";
import Navigation from "@/AppComponents/Navigation.vue";
import AppFooterMain from "@/AppComponents/AppFooterMain.vue";

const form = useForm({
    name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
    acceptPromotions: true,
});

</script>

<template>
    <Navigation/>
    <div class="entry-form mb-[20px] flex justify-center items-center">
        <form @submit.prevent.stop="form.post(route('register'))">
            <h2 class="p-0">Register</h2>

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
                <InputError class="mt-2" :message="form.errors.name"/>
            </div>
            <div>
                <label>Email Address</label>
                <TextInput
                    id="email"
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
                <InputError class="mt-2" :message="form.errors.phone"/>
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
                <InputError class="mt-2" :message="form.errors.password_confirmation"/>
            </div>
            <div class="!mb-[30px]">
                <InputLabel for="terms">
                    <div class="flex">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" class="mr-[20px] p-0" required/>
                        <p class="text-sm text-white p-0 m-0">By creating an account,I have read and agree to the <a href="/termsOfService">terms and condition</a> and the <a href="/privacyPolicy">
                            privacy policy</a></p>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms"/>
                </InputLabel>
                <InputLabel for="terms">
                    <div class="flex">
                        <Checkbox id="terms" v-model:checked="form.acceptPromotions" name="terms" class="mr-[20px] p-0" required/>
                        <p class="text-sm text-white p-0 m-0">I accept to receive promotional and marketing emails</p>
                    </div>
                    <InputError class="mt-2" :message="form.errors.acceptPromotions"/>
                </InputLabel>
            </div>
            <button class="mb-[20px]">Sign Up</button>
            <p>Already have an account?
                <Link :href="route('sign-in')" class="text-orange-400 underline">Log In</Link>
            </p>
        </form>
    </div>
    <app-footer-main/>
</template>
