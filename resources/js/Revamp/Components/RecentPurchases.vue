<template>
    <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
            <CardTitle class="text-base font-medium">Recent Purchases</CardTitle>
            <Button
                @click="$emit('pageChange', 'transactions')"
                variant="ghost"
                size="sm"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white"
            >
                View all
            </Button>
        </CardHeader>
        <CardContent>
            <div class="space-y-4">
                <div
                    v-for="purchase in recentPurchases"
                    :key="purchase.id"
                    class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors cursor-pointer"
                    @click="$emit('pageChange', 'transactions')"
                >
                    <div class="flex items-center space-x-3">
                        <Avatar class="h-8 w-8">
                            <AvatarImage v-if="purchase.user.avatar" :src="purchase.user.avatar"
                                         :alt="purchase.user.name"/>
                            <AvatarFallback class="bg-orange-500 text-white text-sm">
                                {{ purchase.user.name.split(' ').map(n => n[0]).join('') }}
                            </AvatarFallback>
                        </Avatar>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                {{ purchase.user.name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ purchase.package }} • {{ formatTimeAgo(purchase.timestamp) }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            KES {{ purchase.amount.toLocaleString() }}
                        </p>
                        <div class="flex items-center space-x-1">
                            <div :class="`w-2 h-2 rounded-full ${getStatusColor(purchase.status)}`"></div>
                            <span class="text-xs text-gray-500 dark:text-gray-400 capitalize">
                {{ purchase.status }}
              </span>
                        </div>
                    </div>
                </div>

                <div v-if="recentPurchases.length === 0" class="text-center py-8">
                    <div class="text-gray-400 mb-2">
                        <ShoppingBag class="h-8 w-8 mx-auto"/>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No recent purchases</p>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ todaysPurchases }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Today
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            KES {{ todaysRevenue.toLocaleString() }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Revenue
                        </p>
                    </div>
                </div>
            </div>
        </CardContent>
    </Card>
</template>

<script setup lang="ts">
import {ref, computed, onMounted} from 'vue'
import {ShoppingBag} from 'lucide-vue-next'
import Button from './ui/button.vue'
import {Card, CardContent, CardHeader, CardTitle} from './ui/Cards/cardsLoader'
import Avatar from "@/Revamp/Components/ui/Avatar/Avatar.vue";
import AvatarImage from "@/Revamp/Components/ui/Avatar/AvatarImage.vue";
import AvatarFallback from "@/Revamp/Components/ui/Avatar/AvatarFallback.vue";

interface Purchase {
    id: string
    user: {
        name: string
        avatar?: string
    }
    package: string
    amount: number
    status: 'completed' | 'pending' | 'failed'
    timestamp: string
}

defineEmits<{
    pageChange: [page: string]
}>()

// Reactive state
const purchases = ref<Purchase[]>([])

// Generate mock purchase data
const generatePurchases = (): Purchase[] => {
    const users = [
        {name: 'John Doe', avatar: ''},
        {name: 'Jane Smith', avatar: ''},
        {name: 'Mike Johnson', avatar: ''},
        {name: 'Sarah Wilson', avatar: ''},
        {name: 'David Brown', avatar: ''},
        {name: 'Lisa Anderson', avatar: ''},
        {name: 'Tom Wilson', avatar: ''},
        {name: 'Emily Davis', avatar: ''}
    ]

    const packages = [
        'Professional Plan',
        'Expert Plan',
        'Starter Plan',
        'Weekend Special',
        'Champions Package'
    ]

    const amounts = [499, 899, 1899, 2999, 4999]
    const statuses: Purchase['status'][] = ['completed', 'pending', 'failed']
    const statusWeights = [0.8, 0.15, 0.05] // 80% completed, 15% pending, 5% failed

    const getWeightedStatus = () => {
        const rand = Math.random()
        let cumulativeWeight = 0

        for (let i = 0; i < statuses.length; i++) {
            cumulativeWeight += statusWeights[i]
            if (rand <= cumulativeWeight) {
                return statuses[i]
            }
        }
        return statuses[0]
    }

    const mockPurchases: Purchase[] = []

    for (let i = 0; i < 15; i++) {
        const user = users[Math.floor(Math.random() * users.length)]
        const packageName = packages[Math.floor(Math.random() * packages.length)]
        const amount = amounts[Math.floor(Math.random() * amounts.length)]
        const status = getWeightedStatus()

        // Generate timestamp within last 24 hours
        const timestamp = new Date()
        timestamp.setHours(timestamp.getHours() - Math.floor(Math.random() * 24))

        mockPurchases.push({
            id: `PUR${String(i + 1001).padStart(4, '0')}`,
            user,
            package: packageName,
            amount,
            status,
            timestamp: timestamp.toISOString()
        })
    }

    return mockPurchases.sort((a, b) => new Date(b.timestamp).getTime() - new Date(a.timestamp).getTime())
}

// Computed properties
const recentPurchases = computed(() => purchases.value.slice(0, 8))

const todaysPurchases = computed(() => {
    const today = new Date().toDateString()
    return purchases.value.filter(purchase =>
        new Date(purchase.timestamp).toDateString() === today &&
        purchase.status === 'completed'
    ).length
})

const todaysRevenue = computed(() => {
    const today = new Date().toDateString()
    return purchases.value
        .filter(purchase =>
            new Date(purchase.timestamp).toDateString() === today &&
            purchase.status === 'completed'
        )
        .reduce((sum, purchase) => sum + purchase.amount, 0)
})

// Methods
const formatTimeAgo = (timestamp: string) => {
    const date = new Date(timestamp)
    const now = new Date()
    const diffInMinutes = Math.floor((now.getTime() - date.getTime()) / (1000 * 60))

    if (diffInMinutes < 1) return 'Just now'
    if (diffInMinutes < 60) return `${diffInMinutes}m ago`
    if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)}h ago`
    return `${Math.floor(diffInMinutes / 1440)}d ago`
}

const getStatusColor = (status: string) => {
    switch (status) {
        case 'completed':
            return 'bg-green-500'
        case 'pending':
            return 'bg-orange-500'
        case 'failed':
            return 'bg-red-500'
        default:
            return 'bg-gray-500'
    }
}

// Initialize data
onMounted(() => {
    purchases.value = generatePurchases()
})
</script>
