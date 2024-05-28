<script setup>
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";
import {updateInfo, updatePassword} from "@/Pages/Administration/Profile/Actions.js";
import {initializeForms} from "@/Pages/Administration/Profile/forms.js";

const {userForm, securityForm} = initializeForms();

const handleUpdateInfo = () => {
    updateInfo(userForm);
};

const handleUpdatePassword = () => {
    updatePassword(securityForm, userForm.id);
};
</script>

<template>
    <DashboardLayout :title="'Profile'" :page-heading="'Profile'">
        <div class="flex w-full px-[20px] gap-2.5">
            <div class="w-8/12">
                <div class="form-container">
                    <div class="form-header">
                        <h1>Profile</h1>
                        <p class="badge">{{ userForm.status }}</p>
                    </div>
                    <form>

                        <div class="app-form-group">
                            <label>Username</label>
                            <input v-model="userForm.name">
                            <p class="error">{{ userForm.errors.name }}</p>
                        </div>

                        <div class="app-form-group flex gap-2.5">

                            <div class="w-full">
                                <label>Phone</label>
                                <input class="" v-model="userForm.phone">
                                <p class="error">{{ userForm.errors.phone }}</p>
                            </div>

                            <div class="w-full">
                                <label>Email</label>
                                <input class="" v-model="userForm.email">
                                <p class="error">{{ userForm.errors.email }}</p>
                            </div>

                        </div>

                        <button class="form-action-button" @click.prevent.stop="handleUpdateInfo">Update</button>

                    </form>
                </div>
                <div class="form-container">
                    <div class="form-header">
                        <h1>Security</h1>
                    </div>
                    <form>

                        <div class="app-form-group">
                            <label>Current Password</label>
                            <input type="password" v-model="securityForm.current_password">
                            <p class="error">{{ securityForm.errors.current_password }}</p>
                        </div>

                        <div class="app-form-group">
                            <label>New Password</label>
                            <input type="password" v-model="securityForm.password">
                            <p class="error">{{ securityForm.errors.password }}</p>
                        </div>

                        <div class="app-form-group">
                            <label>Confirm New Password</label>
                            <input type="password" v-model="securityForm.password_confirmation">
                            <p class="error">{{ securityForm.errors.password_confirmation }}</p>
                        </div>

                        <button class="form-action-button" @click.stop.prevent="handleUpdatePassword">Update</button>

                    </form>
                </div>
            </div>
            <div class="w-4/12">
                <div class="form-container">
                    <div class="form-header">
                        <h1>Danger Zone</h1>
                    </div>
                    <form>
                        <div class="app-form-group">
                            <label >Enter your username to confirm Action</label>
                            <input >
                        </div>
                        <div class="mx-auto flex] mb-[30px] flex flex-col gap-2.5">
                            <button class="form-action-button">Disable Account</button>
                            <button class="form-action-button !bg-red-600">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<style scoped lang="scss">
@import "./Accounts";
</style>
