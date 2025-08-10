<template>
    <Card class="col-span-1 h-[500px]">
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-base font-medium">Income Summary</CardTitle>
            <div class="flex gap-2">
                <Select v-model="selectedType">
                    <SelectTrigger class="w-[120px]">
                        <SelectValue placeholder="Type"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="transactions">Transactions</SelectItem>
                        <SelectItem value="tips">Tips</SelectItem>
                    </SelectContent>
                </Select>
                <Select v-model="selectedPeriod">
                    <SelectTrigger class="w-[120px]">
                        <SelectValue placeholder="Period"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="daily">Daily</SelectItem>
                        <SelectItem value="weekly">Weekly</SelectItem>
                        <SelectItem value="monthly">Monthly</SelectItem>
                    </SelectContent>
                </Select>
            </div>
        </CardHeader>

        <CardContent>
            <div class="h-[300px] -ml-4">
                <Bar :data="chartData" :options="chartOptions"/>
            </div>

            <div
                class="mt-6 bg-muted p-4 rounded-md flex items-center justify-center gap-6 text-sm text-muted-foreground">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                    Successful KES
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-black"></span>
                    Failed KES
                </div>
            </div>
        </CardContent>
    </Card>
</template>

<script setup lang="ts">
import {ref, computed} from 'vue'
import {Bar} from 'vue-chartjs'
import {
    Chart as ChartJS,
    BarElement,
    CategoryScale,
    LinearScale,
    Tooltip,
    Title
} from 'chart.js'

import {Card, CardContent, CardHeader, CardTitle} from "./ui/Cards/cardsLoader"
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from './ui/Select/selectLoader'

// Register Chart.js components
ChartJS.register(BarElement, CategoryScale, LinearScale, Tooltip, Title)

const selectedPeriod = ref('daily')
const selectedType = ref('transactions')

const dataset = computed(() => {
    // mock logic – same values regardless of type for demo
    return {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        successful: [4200, 3300, 2700, 3600, 3100, 3300, 3700],
        failed: [3000, 1800, 9900, 4400, 4700, 3900, 4100]
    }
})

const chartData = computed(() => ({
    labels: dataset.value.labels,
    datasets: [
        {
            label: 'Successful KES',
            data: dataset.value.successful,
            backgroundColor: '#f97316', // Tailwind orange-500
            borderRadius: 6,
            barThickness: 22
        },
        {
            label: 'Failed KES',
            data: dataset.value.failed,
            backgroundColor: '#000000',
            borderRadius: 6,
            barThickness: 22
        }
    ]
}))

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {display: false},
        tooltip: {
            backgroundColor: '#fff',
            borderColor: '#ccc',
            borderWidth: 1,
            titleColor: '#000',
            bodyColor: '#000',
            cornerRadius: 6,
            callbacks: {
                label: (tooltipItem: any) => {
                    const value = tooltipItem.raw
                    return `KES ${value.toLocaleString()}`
                }
            }
        }
    },
    scales: {
        y: {
            ticks: {
                callback: (value: number) => `KES ${(value / 1000).toFixed(0)}k`,
                color: 'rgba(0, 0, 0, 0.6)',
                font: {size: 12}
            },
            grid: {
                color: 'rgba(0, 0, 0, 0.1)',
                borderDash: [4, 4]
            }
        },
        x: {
            ticks: {
                color: 'rgba(0, 0, 0, 0.6)',
                font: {size: 12}
            },
            grid: {
                display: false
            }
        }
    }
}
</script>
