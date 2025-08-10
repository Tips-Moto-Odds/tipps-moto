<template>
    <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Left side - Page title and breadcrumb -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <Link
                        :href="route('home')"
                        @click="$emit('page-change', 'dashboard')"
                        class="p-1 hover:bg-gray-100 dark:hover:bg-gray-800 rounded transition-colors"
                    >
                        <Home @click.prevent="" class="h-5 w-5 text-gray-600 dark:text-gray-400"/>
                    </Link>
                    <ChevronRight class="h-4 w-4 mr-2 text-gray-400"/>
                    <h1 class="text-2xl font-semibold p-0 m-0 text-gray-900 dark:text-white">
                        {{ pageTitle }}
                    </h1>
                </div>
            </div>

            <!-- Right side - Search, notifications, and user menu -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div class="relative">
                    <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"/>
                    <input
                        type="text"
                        placeholder="Search..."
                        class="pl-10 pr-4 py-2 bg-gray-100 dark:bg-gray-800 border-0 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:bg-white dark:focus:bg-gray-700 transition-colors w-64"
                    />
                </div>

                <!-- Notifications -->
                <NotificationDropdown :currentPage="currentPage"/>

                <!-- User Menu -->
                <div class="relative ">
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <button
                                class="flex  items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                                <Avatar class="h-8 w-8">
                                    <AvatarImage v-if="currentAdmin.avatar" :src="currentAdmin.avatar"
                                                 :alt="`${currentAdmin.firstName} ${currentAdmin.lastName}`"/>
                                    <AvatarFallback class="bg-orange-500 text-white font-medium">
                                        {{ currentAdmin.firstName[0] }}{{ currentAdmin.lastName[0] }}
                                    </AvatarFallback>
                                </Avatar>
                                <div class="text-left hidden sm:block">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ currentAdmin.firstName }} {{ currentAdmin.lastName }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ currentAdmin.role }}
                                    </div>
                                </div>
                                <ChevronDown class="h-4 w-4 text-gray-400"/>
                            </button>
                        </DropdownMenuTrigger>

                        <DropdownMenuContent class="bg-white w-80 mr-4" align="end">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <Avatar class="h-10 w-10">
                                        <AvatarImage v-if="currentAdmin.avatar" :src="currentAdmin.avatar"
                                                     :alt="`${currentAdmin.firstName} ${currentAdmin.lastName}`"/>
                                        <AvatarFallback class="bg-orange-500 text-white font-medium">
                                            {{ currentAdmin.firstName[0] }}{{ currentAdmin.lastName[0] }}
                                        </AvatarFallback>
                                    </Avatar>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ currentAdmin.firstName }} {{ currentAdmin.lastName }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ currentAdmin.email }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ currentAdmin.role }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-2">
                                <DropdownMenuItem
                                    @click="$emit('page-change', 'profile')"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                                >
                                    <User class="h-4 w-4 mr-3"/>
                                    My Profile
                                </DropdownMenuItem>

                                <DropdownMenuItem
                                    @click="$emit('page-change', 'settings')"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                                >
                                    <Settings class="h-4 w-4 mr-3"/>
                                    Settings
                                </DropdownMenuItem>

                                <DropdownMenuSeparator/>

                                <DropdownMenuItem
                                    @click="handleLogout"
                                    class="flex items-center px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 cursor-pointer"
                                >
                                    <LogOut class="h-4 w-4 mr-3"/>
                                    Sign Out
                                </DropdownMenuItem>
                            </div>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import {computed} from 'vue'
import {
    Search,
    Home,
    ChevronRight,
    ChevronDown,
    User,
    Settings,
    LogOut
} from 'lucide-vue-next'
import NotificationDropdown from './NotificationDropdown.vue'
import DropdownMenu from "@/Revamp/Components/ui/DropdownMenu/DropdownMenu.vue";
import DropdownMenuTrigger from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuTrigger.vue";
import Avatar from "@/Revamp/Components/ui/Avatar/Avatar.vue";
import AvatarImage from "@/Revamp/Components/ui/Avatar/AvatarImage.vue";
import AvatarFallback from "@/Revamp/Components/ui/Avatar/AvatarFallback.vue";
import DropdownMenuContent from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuContent.vue";
import DropdownMenuItem from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuItem.vue";
import DropdownMenuSeparator from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuSeparator.vue";
import {Link} from "@inertiajs/vue3";
import {Inertia} from "@inertiajs/inertia";
import {Router} from "@inertiajs/inertia/types/router";

const props = defineProps(['currentPage', 'currentAdmin'])

defineEmits(['page-change'])

const pageTitle = computed(() => {
    const titles = {
        'dashboard': 'Dashboard',
        'accounts': 'User Accounts',
        'matches': 'Matches',
        'tips': 'Tips Management',
        'subscriptions': 'Subscription Packages',
        'transactions': 'Transactions',
        'notifications': 'Notifications',
        'support': 'Customer Support',
        'settings': 'Settings',
        'profile': 'My Profile',
        'marketing': 'Marketing',
        'affiliate': 'Affiliate Program',
        'system': 'System Analytics',
        'model': 'AI Model'
    }
    return titles[props.currentPage] || 'Dashboard'
})

const handleLogout = () => {
    // Handle logout functionality
    console.log('Logging out...')
    // In a real app, you would clear auth tokens and redirect to login
}
</script>
