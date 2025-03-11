<script setup>
import TextInput from "@/Components/TextInput.vue";
import {onUpdated, ref} from "vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {sendRequest} from "@/Pages/Users/Tips/Actions.js";

const page = usePage()
const form =  useForm({
    package:"Daily",
    phone:"0719445697",
})

const notSent = ref(false);

const close = () => $('#subscription_panel').fadeOut()

onUpdated(() => {
    if(page.props.flash?.error){
        alert(page.props.flash?.error)
    }
})
</script>

<template>
    <div class="w-full h-full" id="subscription_panel">
        <div class="w-full h-full absolute top-0 left-0 flex justify-center items-center"
             style="background-color: rgba(0,0,0,0.5)">
            <div class="app-panel rounded-sm shadow-2xl p-[10px]" style="width:min(100%, 370px)">
                <div class="app-panel-heading flex  justify-between">
                    <h1>Subscribe</h1>
                    <div>
                        <svg @click="close" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#F26166" class="bi bi-x-circle"
                             viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                </div>
                <form v-if="!notSent"  class="text-white">
                    <div>
                        <p class="mb-[10px]">Please select a package and enter the phone number the payment request will be sent to.</p>
                    </div>
                    <div class="mb-[20px]">
                        <label>Package</label>
                        <select v-model="form.package" class="mt-1 block w-full text-gray-600 rounded">
                            <option value="">Select Package</option>
                            <option value="Daily">Daily (Ksh 150)</option>
                            <option value="Weekly">Weekly  (Ksh 700)</option>
                            <option value="Monthly ">Monthly (Ksh 2500)</option>
                        </select>
                    </div>
                    <div class="mb-[20px]">
                        <label>Phone Number</label>
                        <TextInput
                            id="name"
                            type="number"
                            class="mt-1 block w-full text-gray-600"
                            required
                            autofocus
                            autocomplete="name"
                            v-model="form.phone"
                        />
                    </div>
                    <div>
                        <button class="py-[4px] block bg-blue-400 w-full rounded" @click.prevent.stop="sendRequest(form,page)">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>

</style>
