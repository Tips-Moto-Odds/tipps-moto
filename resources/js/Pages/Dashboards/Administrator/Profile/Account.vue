<script setup>
import {updateInfo, updatePassword} from "@/Pages/Users/Profile/Actions.js";
import {initializeForms} from "@/Pages/Users/Profile/forms.js";
import {usePage} from "@inertiajs/vue3";
import {onUpdated} from "vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import UserAaccountNavigation from "@/AppComponents/Users/UserAaccountNavigation.vue";
import DashboardLayout from "@/Layouts/AdministrationLayout/DashboardLayout.vue";

const page = usePage()
const {userForm, securityForm} = initializeForms();
const handleUpdateInfo = () => {
    updateInfo(userForm);
};

const handleUpdatePassword = () => {
    updatePassword(securityForm, userForm);
};

onUpdated(() => {
    if (page.props.flash?.success) {
        alert(page.props.flash?.success)
    }
})
</script>

<template>
    <DashboardLayout page-heading="Profile" title="Profile">
        <section class="container">
            <div class="w-full p-2">
                <div class="app-panel form-container">
                    <div class="form-header flex justify-between">
                        <h5>User Details</h5>
                        <p class="badge">{{ userForm.status }}</p>
                    </div>
                    <form>
                        <div class="app-form-group">
                            <label>Username</label>
                            <input class="md:!w-[500px]" v-model="userForm.name">
                            <p class="error">{{ userForm.errors.name }}</p>
                        </div>
                        <div class="app-form-group">
                            <label>Phone</label>
                            <input class="md:!w-[500px]" v-model="userForm.phone" >
                            <p class="error">{{ userForm.errors.phone }}</p>
                        </div>
                        <div class="app-form-group">
                            <label>Email</label>
                            <input class="md:!w-[500px]" v-model="userForm.email">
                            <p class="error">{{ userForm.errors.email }}</p>
                        </div>
                        <button class="form-action-button" @click.prevent.stop="handleUpdateInfo">Update</button>
                    </form>
                </div>
                <section class=" flex flex-col md:flex-row">
                    <div class="app-panel form-container mr-[10px]" style="width: 100%">
                        <div class="form-header">
                            <h5>Security</h5>
                        </div>
                        <form>

                            <div class="app-form-group">
                                <label>Current Password</label>
                                <input v-model="securityForm.current_password" type="password">
                                <p class="error">{{ securityForm.errors.current_password }}</p>
                            </div>

                            <div class="app-form-group">
                                <label>New Password</label>
                                <input v-model="securityForm.password" type="password">
                                <p class="error">{{ securityForm.errors.password }}</p>
                            </div>

                            <div class="app-form-group">
                                <label>Confirm New Password</label>
                                <input v-model="securityForm.password_confirmation" type="password">
                                <p class="error">{{ securityForm.errors.password_confirmation }}</p>
                            </div>

                            <button class="form-action-button" @click.stop.prevent="handleUpdatePassword">Update</button>

                        </form>
                    </div>
                    <div class="app-panel form-container" style="width: 100%">
                        <div class="form-header">
                            <h5>Danger Zone</h5>
                        </div>
                        <form>
                            <div class="app-form-group">
                                <label class="!w-full mb-[20px] block">Enter your username to confirm Action</label>
                                <input class="mb-[20px] block !w-full" type="text">
                            </div>

                            <div class="mx-auto flex] mb-[30px] flex flex-col gap-2.5">
                                <button class="form-action-button !bg-red-500">Disable Account</button>
                            </div>
                        </form>
                    </div>
                </section>

            </div>
        </section>
    </DashboardLayout>
</template>
<style scoped lang="scss">
label, h5 {
    @apply text-white;
}

.form-header{
    @apply mb-[5px] p-[10px];
}

.form-container {
    @apply pb-[20px];
    form{
        @apply px-[20px]
    }
}

.form-action-button{
    @apply px-[10px] py-[5px] text-white bg-gray-500 hover:bg-orange-500;
}

.app-form-group {
    @apply mb-[10px];
    label {
        @apply w-[200px] mb-[10px]
    }

    input {
        @apply rounded w-full px-[5px] py-[4px] m-0
    }
}

.app-form-group:last-of-type{
    @apply mb-[30px];
}

p.error{
    @apply text-red-500 text-right;
}
</style>

