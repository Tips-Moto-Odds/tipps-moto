<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

// Initialize form
const form = useForm({
    facebookName: '',
    whatsappNumber: '',
    email: '',
});

function handleSubmit() {

    console.log('Data submitted successfully:', form);

    window.location.href = "https://whatsapp.com/channel/0029VagdQJFBfxo8DiYaBI06";

    return;

    // Submit form data to the server
    form.post('/your-server-endpoint', {
        onSuccess: () => {
            // Log form data to console after a successful response
            console.log('Data submitted successfully:', form.data);

            // Redirect user to the WhatsApp channel
            window.location.href = "https://whatsapp.com/channel/0029VagdQJFBfxo8DiYaBI06";
        },
        onError: (errors) => {
            // Handle validation or server errors here
            console.error('Error submitting form:', errors);
        },
    });
}
</script>

<template>
    <div class="min-h-screen p-[20px] flex justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg border max-w-md w-full">
            <!-- Form Header -->
            <h1 class="text-center text-2xl font-bold mb-4 text-orange-600">Join Our Channel</h1>
            <p class="text-center text-gray-600 mb-6">Fill the form below to connect with us on WhatsApp.</p>

            <!-- Form -->
            <form @submit.prevent="handleSubmit" class="space-y-4">
                <!-- Facebook Username -->
                <div class="mb-[20px]">
                    <label for="facebookName" class="block text-sm font-medium text-gray-700 mb-1">Facebook Name</label>
                    <input
                        v-model="form.facebookName"
                        type="text"
                        id="facebookName"
                        class="form-control block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Your Facebook Name"
                        required
                    />
                </div>

                <!-- WhatsApp Phone Number -->
                <div class="mb-[20px]">
                    <label for="whatsappNumber" class="block text-sm font-medium text-gray-700 mb-1">WhatsApp Number</label>
                    <input
                        v-model="form.whatsappNumber"
                        type="tel"
                        id="whatsappNumber"
                        class="form-control block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Your WhatsApp Number"
                        required
                    />
                </div>

                <!-- Email -->
                <div class="mb-[20px]">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        id="email"
                        class="form-control block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-orange-500 focus:border-orange-500"
                        placeholder="Your Email Address"
                        required
                    />
                </div>

                <!-- Submit Button -->
                <div>
                    <button
                        type="submit"
                        class="btn btn-primary block w-full py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-1"
                        :disabled="form.processing">
                        {{ form.processing ? 'Submitting...' : 'Join WhatsApp Channel' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
