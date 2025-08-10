<template>
    <div
        :class="`fixed left-0 top-0 h-full bg-black text-white transition-all duration-300 z-50 flex flex-col ${collapsed ? 'w-16' : 'w-64'}`">
        <!-- Logo/Header -->
        <div
            :class="`flex items-center px-4 py-6 border-b border-gray-800 ${collapsed ? 'justify-center' : 'justify-between'}`">
            <div v-if="!collapsed" class="flex items-center space-x-2">
                <div
                    class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                    <span class="text-white text-base font-bold">TM</span>
                </div>
                <span class="text-xl font-bold">Tips Moto</span>
            </div>
            <div v-else
                 class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                <span class="text-white text-base font-bold">TM</span>
            </div>
            <button
                v-if="!collapsed"
                @click="$emit('toggle', !collapsed)"
                class="p-1 hover:bg-gray-800 rounded transition-colors"
            >
                <ChevronLeft class="h-5 w-5"/>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <div class="space-y-2">
                <!-- Main Navigation -->
                <div>
                    <h3 v-if="!collapsed" class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Main
                    </h3>
                    <div class="space-y-1">
                        <button
                            v-for="item in mainNavigation"
                            :key="item.id"
                            @click="$emit('page-change', item.id)"
                            :class="`w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group ${
                currentPage === item.id
                  ? 'bg-orange-500 text-white'
                  : 'text-gray-300 hover:bg-gray-800 hover:text-white'
              } ${collapsed ? 'justify-center' : ''}`"
                        >
                            <component :is="item.icon" :class="`h-5 w-5 ${collapsed ? '' : 'mr-3'}`"/>
                            <span v-if="!collapsed">{{ item.name }}</span>
                            <span v-if="item.badge && !collapsed"
                                  :class="`ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full ${item.badge === 'NEW' ? 'bg-green-600' : ''}`">
                {{ item.badge }}
              </span>
                        </button>
                    </div>
                </div>

                <!-- Management Section -->
                <div class="pt-6">
                    <h3 v-if="!collapsed" class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        Management
                    </h3>
                    <div class="space-y-1">
                        <button
                            v-for="item in managementNavigation"
                            :key="item.id"
                            @click="$emit('page-change', item.id)"
                            :class="`w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group ${
                currentPage === item.id
                  ? 'bg-orange-500 text-white'
                  : 'text-gray-300 hover:bg-gray-800 hover:text-white'
              } ${collapsed ? 'justify-center' : ''}`"
                        >
                            <component :is="item.icon" :class="`h-5 w-5 ${collapsed ? '' : 'mr-3'}`"/>
                            <span v-if="!collapsed">{{ item.name }}</span>
                        </button>
                    </div>
                </div>

                <!-- System Section -->
                <div class="pt-6">
                    <h3 v-if="!collapsed" class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">
                        System
                    </h3>
                    <div class="space-y-1">
                        <button
                            v-for="item in systemNavigation"
                            :key="item.id"
                            @click="$emit('page-change', item.id)"
                            :class="`w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors group ${
                currentPage === item.id
                  ? 'bg-orange-500 text-white'
                  : 'text-gray-300 hover:bg-gray-800 hover:text-white'
              } ${collapsed ? 'justify-center' : ''}`"
                        >
                            <component :is="item.icon" :class="`h-5 w-5 ${collapsed ? '' : 'mr-3'}`"/>
                            <span v-if="!collapsed">{{ item.name }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Expand Button (when collapsed) -->
        <div v-if="collapsed" class="p-4 border-t border-gray-800">
            <button
                @click="$emit('toggle', !collapsed)"
                class="w-full p-2 hover:bg-gray-800 rounded transition-colors flex items-center justify-center"
            >
                <ChevronRight class="h-5 w-5"/>
            </button>
        </div>
    </div>
</template>

<script setup lang="ts">
import {
    LayoutDashboard,
    Users,
    Calendar,
    Target,
    CreditCard,
    Package,
    Bell,
    HeadphonesIcon,
    Settings,
    BarChart3,
    Brain,
    ChevronLeft,
    ChevronRight
} from 'lucide-vue-next'

interface Props {
    collapsed: boolean
    currentPage: string
}

defineProps<Props>()

defineEmits<{
    toggle: [value: boolean]
    'page-change': [page: string]
}>()

const mainNavigation = [
    {id: 'dashboard', name: 'Dashboard', icon: LayoutDashboard, badge: null},
    {id: 'accounts', name: 'Accounts', icon: Users, badge: '12'},
    {id: 'matches', name: 'Matches', icon: Calendar, badge: null},
    {id: 'tips', name: 'Tips', icon: Target, badge: 'NEW'},
    {id: 'subscriptions', name: 'Subscriptions', icon: Package, badge: null},
    {id: 'transactions', name: 'Transactions', icon: CreditCard, badge: null}
]

const managementNavigation = [
    {id: 'notifications', name: 'Notifications', icon: Bell, badge: '3'},
    {id: 'support', name: 'Customer Support', icon: HeadphonesIcon, badge: null}
]

const systemNavigation = [
    {id: 'settings', name: 'Settings', icon: Settings, badge: null},
    {id: 'system', name: 'System', icon: BarChart3, badge: null},
    {id: 'model', name: 'Model', icon: Brain, badge: null}
]
</script>
