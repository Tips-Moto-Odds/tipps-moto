<script setup>
import { ref, onMounted } from "vue";

// Reactive variable to control the visibility of the popup modal
const isModalOpen = ref(false);

// Function to toggle the modal's visibility
function toggleModal() {
    isModalOpen.value = !isModalOpen.value; // Toggle the modal state (open/close)
}

// Display the modal 2 seconds after the component is mounted
onMounted(() => {
    setTimeout(() => {
        isModalOpen.value = true; // Show the modal
    }, 10000);
});
</script>

<template>
    <!-- Popup modal -->
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-[10px]" style="z-index: 10000">
        <div class="bg-white p-2 rounded-lg shadow-lg max-w-sm w-full relative">
            <Link href="/fb-give-away" as="div" class="bg-black">
                <img style="width: 100%" src="/storage/System/fb-promo.png">
            </Link>
            <div class="flex justify-center mt-2 mb-2 gap-2">
                <!-- Close modal on clicking Cancel -->
                <button @click="toggleModal" class="py-2 px-4 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
            </div>
        </div>
    </div>
</template>
