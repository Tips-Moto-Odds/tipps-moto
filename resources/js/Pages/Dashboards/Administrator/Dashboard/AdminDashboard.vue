<script setup>
const props = defineProps({
    model: Object,
    users: Object,
    payments: Object,
});
</script>

<template>
    <div class="px-2 md:px-4">
        <div class="app-card w-full rounded p-4 md:p-6">
            <!-- Summary Cards -->
            <ul class="flex flex-col md:flex-row justify-around mb-8">
                <li class="display-card">
                    <div class="icon-container">
                        <img class="h-12" src="/storage/System/Icons/user-icon.png">
                    </div>
                    <div class="info">
                        <h3>Users</h3>
                        <p>{{ users?.users?.length || 0 }}</p>
                        <p>{{ users?.users?.length || 0 }}</p>
                    </div>
                </li>

                <li class="display-card">
                    <div class="icon-container">
                        <img width="60" height="60" src="https://img.icons8.com/ios-glyphs/90/3AD863/money--v1.png" alt="money icon"/>
                    </div>
                    <div class="info">
                        <h3>Payments</h3>
                        <p>Ksh {{ payments?.payments || 0 }}</p>
                    </div>
                </li>

                <li class="display-card">
                    <div class="icon-container">
                        <img width="50" height="50" src="https://img.icons8.com/ios/50/0ED3E2/artificial-intelligence.png" alt="AI"/>
                    </div>
                    <div class="info">
                        <h3>Model Accuracy</h3>
                        <p>{{ model?.model || 0 }}%</p>
                    </div>
                </li>
            </ul>

            <!-- Income Summary -->
            <section class="flex flex-col md:flex-row gap-4 mb-16">
                <div class="md:w-8/12">
                    <h6 class="text-white">Income Summary</h6>
                    <h5 class="text-sm text-gray-200 mb-4">Summary</h5>
                    <div class="bg-gray-500 w-full h-[300px] rounded"></div>
                </div>
                <div class="md:w-4/12 bg-gray-700 rounded p-4">
                    <h6 class="text-white mb-4">Recent Purchases</h6>
                    <ul class="text-white text-sm">
                        <li v-for="(_, i) in Array(5).fill(null)" :key="i" class="mb-2">
                            <div class="flex justify-between">
                                <p>Username</p>
                                <p>Ksh 200</p>
                            </div>
                            <hr class="border-gray-500">
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Recent Activity -->
            <section class="mb-6">
                <h6 class="text-white mb-4 font-bold">Recent Activity</h6>
                <table class="text-white w-full">
                    <thead class="h-12">
                    <tr class="border-b-2 text-sm">
                        <th>Type</th>
                        <th>Initiator</th>
                        <th>Date/Time</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(_, i) in Array(10).fill(null)" :key="i" class="border-b h-16">
                        <td>Prediction</td>
                        <td>
                            <p class="mb-1">Administrator</p>
                            <p class="text-sm text-gray-300">admin@email.com</p>
                        </td>
                        <td>
                            <p class="mb-1">00:00 PM</p>
                            <p class="text-gray-300">00/00/00</p>
                        </td>
                        <td class="w-[40%] pr-4">
                            <p class="line-clamp-2">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Ab autem cum dolore esse fuga numquam sit voluptatibus.
                                Amet dignissimos dolorem, et inventore molestiae officia perspiciatis possimus praesentium.
                            </p>
                        </td>
                        <td>Active</td>
                        <td>
                            <button class="text-sm py-1 px-4 bg-red-400 rounded hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</template>

<style scoped lang="scss">
/* Global Card Theme */
.app-card {
    background: linear-gradient(20deg, rgb(65, 65, 65), rgb(73, 73, 73));
}

/* Display Cards */
.display-card {
    @apply w-full flex flex-col items-center text-center mx-2 h-36 rounded-xl p-4 shadow-xl;

    h3, p {
        @apply text-white font-bold;
    }

    span {
        @apply text-gray-300 text-sm mt-2;
    }

    .info {
        @apply flex flex-col justify-between;
    }
}

/* Gradient Backgrounds */
.display-card:nth-of-type(1) {
    background: radial-gradient(circle at top right, rgb(223, 135, 68), rgb(65, 65, 65));
}

.display-card:nth-of-type(2) {
    background: radial-gradient(circle at top right, rgb(68, 223, 104), rgb(65, 65, 65));
}

.display-card:nth-of-type(3) {
    background: radial-gradient(circle at top right, rgb(68, 158, 223), rgb(65, 65, 65));
}

/* Table Styling */
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background: rgba(255, 255, 255, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .display-card {
        @apply w-full;
    }

    .icon-container img {
        width: 40px;
        height: 40px;
    }
}
</style>
