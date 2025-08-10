<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <Card
            v-for="(stat, index) in statsData"
            :key="index"
            class="p-6 hover:shadow-lg transition-all duration-200 cursor-pointer border-l-4"
            :class="stat.borderColor"
        >
            <CardContent>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ stat.title }}
                        </p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ stat.value }}
                        </p>
                    </div>
                    <div :class="`p-3 rounded-full ${stat.iconBg}`">
                        <component :is="stat.icon" :class="`h-6 w-6 ${stat.iconColor}`"/>
                    </div>
                </div>

                <div class="mt-4 flex items-center">
                    <div :class="`flex items-center ${stat.change >= 0 ? 'text-green-600' : 'text-red-600'}`">
                        <component :is="stat.change >= 0 ? TrendingUp : TrendingDown" class="h-4 w-4 mr-1"/>
                        <span class="text-sm font-medium">
              {{ Math.abs(stat.change) }}%
            </span>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">
            from last month
          </span>
                </div>
            </CardContent>
        </Card>
    </div>
</template>

<script setup lang="ts">
import {computed} from 'vue'
import {Users, Calendar, Target, DollarSign, TrendingUp, TrendingDown} from 'lucide-vue-next'
import {Card, CardContent} from './ui/Cards/cardsLoader'

interface Props {
    matches: Array<{
        id: number
        league: string
        homeTeam: string
        awayTeam: string
        date: string
        time: string
        tips: number
        tipsData: Array<{
            id: number
            tipType: string
            subType: string
            value: string
            prediction: string
            riskLevel: string
            winningStatus: string
            free: boolean
        }>
        status: string
        dateTime: Date
    }>
}

const props = defineProps<Props>()

const statsData = computed(() => {
    // Calculate total active users (mock data)
    const totalUsers = 2847

    // Calculate total matches
    const totalMatches = props.matches.length

    // Calculate total tips from all matches
    const totalTips = props.matches.reduce((sum, match) => sum + match.tips, 0)

    // Calculate total revenue (mock calculation based on tips)
    const totalRevenue = totalTips * 15.75 // Average revenue per tip

    // Calculate tips accuracy based on winning status
    const allTips = props.matches.flatMap(match => match.tipsData)
    const completedTips = allTips.filter(tip => tip.winningStatus === 'won' || tip.winningStatus === 'lost')
    const wonTips = completedTips.filter(tip => tip.winningStatus === 'won')
    const accuracy = completedTips.length > 0 ? (wonTips.length / completedTips.length) * 100 : 68.5

    return [
        {
            title: 'Total Users',
            value: totalUsers.toLocaleString(),
            change: 12.5,
            icon: Users,
            iconColor: 'text-blue-600',
            iconBg: 'bg-blue-100 dark:bg-blue-900/20',
            borderColor: 'border-l-blue-500'
        },
        {
            title: 'Active Matches',
            value: totalMatches.toString(),
            change: 8.2,
            icon: Calendar,
            iconColor: 'text-green-600',
            iconBg: 'bg-green-100 dark:bg-green-900/20',
            borderColor: 'border-l-green-500'
        },
        {
            title: 'Tips Generated',
            value: totalTips.toString(),
            change: 15.3,
            icon: Target,
            iconColor: 'text-orange-600',
            iconBg: 'bg-orange-100 dark:bg-orange-900/20',
            borderColor: 'border-l-orange-500'
        },
        {
            title: 'Revenue',
            value: `KES ${Math.round(totalRevenue).toLocaleString()}`,
            change: -3.1,
            icon: DollarSign,
            iconColor: 'text-purple-600',
            iconBg: 'bg-purple-100 dark:bg-purple-900/20',
            borderColor: 'border-l-purple-500'
        }
    ]
})
</script>
