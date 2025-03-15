<script setup>
import {computed, onMounted, reactive} from "vue";
import {router} from "@inertiajs/vue3";


const props = defineProps(['model', 'users','payments','chartData', 'RecentPurchases']);

const urlParams = new URLSearchParams(window.location.search);

const queries = reactive({
    record: urlParams.get('record') || 'Transactions',
    period: urlParams.get('period') || 'Weekly',
    from: urlParams.get('from') || null,
    to: urlParams.get('to') || null
})

// **Dynamic Chart Title Based on Selected Record**
const chartTitle = computed(() => {
    switch (queries.record) {
        case "Subscriptions":
            return "Subscription Summary";
        case "Transactions":
            return "Transaction Summary ";
        default:
            return "Data Summary ";
    }
});

function LoadChartCallback(data) {
    if (queries.record === "Subscriptions") {
        return [data.day, parseFloat(data.success_count)];
    } else {
        return [data.day, parseFloat(data.success), parseFloat(data.pending)];
    }
}

const drawChart = () => {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');

    if (queries.record === "Subscriptions") {
        data.addColumn("number", "Bought Subscriptions");
    } else {
        data.addColumn("number", "Successful KSh");
        data.addColumn("number", "Pending KSh");
    }

    // Get the start of the week (Sunday)
    let startDate = new Date();
    startDate.setDate(startDate.getDate() - startDate.getDay()); // Move to Sunday

    let transactions = props.chartData;

    let formattedData = transactions.map((data) => LoadChartCallback(data));
    data.addRows(formattedData);

    data.addRows(formattedData);

    var options = {
        title: chartTitle.value,
        width: $('#transaction_chart').parent().width(),
        height: 700,
        titleTextStyle: {color: 'white'},
        backgroundColor: {fill: 'transparent'},
        chartArea: {backgroundColor: '#374151'},
        legend: {position: 'top', textStyle: {color: 'white'}},
        hAxis: {textStyle: {color: 'white'}},
        vAxis: {textStyle: {color: 'white'}},
        colors: ['#1de651', '#ffa500'], // Green for successful, Orange for pending
        areaOpacity: 0.3,
        isStacked: true
    };

    var chart = new google.visualization.AreaChart(document.getElementById('transaction_chart'));
    chart.draw(data, options);
};

const filterInsights = () => {
    router.get(route('dashboard'), {
        record: queries.record,
        period: queries.period,
        from: queries.from,
        to: queries.to
    });
};

onMounted(() => {
    google.charts.load('current', {packages: ['corechart'], callback: drawChart});
});

</script>

<template>
    <div class="px-2 md:px-4">
        <div class="app-card w-full rounded py-4 md:p-6">
            <!-- Summary Cards -->
            <ul class="flex flex-col md:flex-row justify-between mb-8 px-0">
                <li class="display-card">
                    <div class="icon-container">
                        <img class="h-12" src="/storage/System/Icons/user-icon.png" alt="user">
                    </div>
                    <div class="info">
                        <h3>Users</h3>
                        <p>{{ users || 0 }}</p>
                    </div>
                </li>

                <li class="display-card">
                    <div class="icon-container">
                        <img width="60" height="60" src="https://img.icons8.com/ios-glyphs/90/3AD863/money--v1.png" alt="money icon"/>
                    </div>
                    <div class="info">
                        <h3>Payments</h3>
                        <p>Ksh {{ payments || 0 }}</p>
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
            <section class="flex flex-col md:flex-row gap-4">
                <div class="md:w-8/12">
                    <h6 class="text-white">Income Summary</h6>
                    <h5 class="text-sm text-gray-200 mb-2">Summary</h5>
                    <div class="p-1 bg-gray-600 rounded overflow-hidden mb-4 flex items-center">
                        <div class="mr-4">
                            <select v-model="queries.record">
                                <option value="Transactions">Transactions</option>
                                <option value="Subscriptions">Subscriptions</option>
                            </select>

                        </div>
                        <div class="mr-4">
                            <select v-model="queries.period">
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Custom">Custom</option>
                            </select>
                        </div>
                        <div v-if="queries.period && queries.period === 'Custom'" class="">
                            <input v-model="queries.from" class="rounded mr-4" type="date" placeholder="From"/>
                            <input v-model="queries.to" class="rounded mr-4" type="date" placeholder="To"/>
                        </div>
                        <div>
                            <button class="btn btn-primary" @click.prevent="filterInsights">Apply</button>
                        </div>
                    </div>
                    <div class="bg-gray-500 w-full rounded overflow-hidden">
                        <div id="transaction_chart"></div>
                    </div>
                </div>
                <div class="md:w-4/12">
                    <h6 class="text-white">Recent Purchases</h6>
                    <h5 class="text-sm text-gray-200 mb-2">Summary</h5>
                    <ul class="text-white text-sm bg-gray-600 p-3 rounded">
                        <li v-for="purchases in RecentPurchases" :key="purchases.id" class="">
                            <div class="flex justify-between">
                                <div>
                                <p>{{purchases.user.name }}</p>
                                <p class="text-gray-300">{{ purchases.user.email }}</p>
                                </div>
                                <div class="text-right">
                                    <p>{{purchases.package.name}}</p>
                                    <p class="text-green-500">Ksh {{purchases.amount }}</p>
                                </div>
                            </div>
                            <hr class="border-gray-500">
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</template>

<style scoped lang="scss">
input, select {
    @apply mb-0;
}

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
    background: radial-gradient(circle at top right, rgb(223, 135, 68), rgb(129, 93, 93));
}

.display-card:nth-of-type(2) {
    background: radial-gradient(circle at top right, rgb(68, 223, 104), rgb(88, 122, 136));
}

.display-card:nth-of-type(3) {
    background: radial-gradient(circle at top right, rgb(68, 158, 223), rgb(66, 117, 76));
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
