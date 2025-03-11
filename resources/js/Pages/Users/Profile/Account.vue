<script setup>
import {updateInfo, updatePassword} from "@/Pages/Users/Profile/Actions.js";
import {initializeForms} from "@/Pages/Users/Profile/forms.js";
import {usePage} from "@inertiajs/vue3";
import {onUpdated} from "vue";
import HomeLayout from "@/Layouts/HomeLayout/HomeLayout.vue";
import UserAaccountNavigation from "@/AppComponents/Users/UserAaccountNavigation.vue";

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
  <HomeLayout>
    <div class="container h-[80px] flex justify-between items-center">
      <h1 class="text-xl text-white">Profile</h1>
      <div class="hidden md:flex">
        <Link as="button" method="POST" href="/logout" @click.prevent="" class="btn btn-primary text-white bg-orange-600 px-[10px] rounded-sm py-1">Log Out</Link>
      </div>
    </div>
    <section class="container flex mb-[50px]">
      <UserAaccountNavigation/>
      <div class="w-full p-2">
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

            <div class="app-form-group md:flex gap-2.5">

              <div class="w-full mb-[10px]">
                <label>Phone</label>
                <input v-model="userForm.phone" class="">
                <p class="error">{{ userForm.errors.phone }}</p>
              </div>

              <div class="w-full">
                <label>Email</label>
                <input v-model="userForm.email" class="">
                <p class="error">{{ userForm.errors.email }}</p>
              </div>

            </div>

            <button class="form-action-button" @click.prevent.stop="handleUpdateInfo">Update</button>

          </form>
        </div>
        <section class="flex flex-col md:flex-row">
          <div class="form-container mr-[10px]" style="width: 100%">
            <div class="form-header">
              <h1>Security</h1>
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
          <div class="form-container" style="width: 100%">
            <div class="form-header">
              <h1>Danger Zone</h1>
            </div>
            <form>
              <div class="app-form-group">
                <label>Enter your username to confirm Action</label>
                <input>
              </div>

              <div class="mx-auto flex] mb-[30px] flex flex-col gap-2.5">
                <button class="form-action-button">Disable Account</button>
              </div>
            </form>
          </div>
        </section>

      </div>
    </section>
  </HomeLayout>
</template>

