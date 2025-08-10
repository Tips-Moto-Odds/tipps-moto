<template>
    <div class="relative">
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <Bell class="h-5 w-5 text-gray-600 dark:text-gray-400"/>
                    <span v-if="unreadCount > 0"
                          class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center notification-badge">
            {{ unreadCount > 9 ? '9+' : unreadCount }}
          </span>
                </button>
            </DropdownMenuTrigger>

            <DropdownMenuContent class="bg-white w-90 mr-4 notification-dropdown" align="end">
                <!-- Header -->
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Notifications</h3>
                        <div class="flex items-center space-x-2">
                            <Button
                                v-if="unreadCount > 0"
                                @click="markAllAsRead"
                                variant="ghost"
                                size="sm"
                                class="text-xs"
                            >
                                Mark all read
                            </Button>
                            <Button
                                @click="viewAllNotifications"
                                variant="ghost"
                                size="sm"
                                class="text-xs"
                            >
                                View all
                            </Button>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ unreadCount }} unread notification{{ unreadCount !== 1 ? 's' : '' }}
                    </p>
                </div>

                <!-- Notifications List -->
                <div class="max-h-96 overflow-y-auto">
                    <div v-if="recentNotifications.length === 0" class="px-4 py-8 text-center">
                        <Bell class="h-8 w-8 text-gray-400 mx-auto mb-2"/>
                        <p class="text-sm text-gray-500 dark:text-gray-400">No notifications</p>
                    </div>

                    <div v-else class="py-2">
                        <div
                            v-for="notification in recentNotifications"
                            :key="notification.id"
                            :class="`notification-item px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800/50 cursor-pointer border-l-4 ${
                !notification.read ? 'notification-unread bg-orange-50/50 dark:bg-orange-900/10' : 'border-l-transparent'
              }`"
                            @click="handleNotificationClick(notification)"
                        >
                            <div class="flex items-start space-x-3">
                                <div :class="`p-2 rounded-full ${getNotificationIconBg(notification.type)}`">
                                    <component :is="getNotificationIcon(notification.type)"
                                               :class="`h-4 w-4 ${getNotificationIconColor(notification.type)}`"/>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <p :class="`text-sm font-medium text-gray-900 dark:text-white ${!notification.read ? 'font-semibold' : ''}`">
                                            {{ notification.title }}
                                        </p>
                                        <Badge v-if="!notification.read" variant="default"
                                               class="bg-orange-500 text-white text-xs">
                                            NEW
                                        </Badge>
                                    </div>

                                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 mb-2">
                                        {{ notification.message }}
                                    </p>

                                    <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                      {{ formatTimeAgo(notification.createdAt) }}
                    </span>
                                        <div class="notification-actions flex items-center space-x-1">
                                            <Button
                                                @click.stop="toggleRead(notification)"
                                                variant="ghost"
                                                size="sm"
                                                class="h-6 w-6 p-0"
                                            >
                                                <component :is="notification.read ? Mail : MailOpen" class="h-3 w-3"/>
                                            </Button>
                                            <Button
                                                @click.stop="removeNotification(notification.id)"
                                                variant="ghost"
                                                size="sm"
                                                class="h-6 w-6 p-0 text-red-500 hover:text-red-700"
                                            >
                                                <X class="h-3 w-3"/>
                                            </Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700">
                    <Button @click="viewAllNotifications" variant="outline" class="w-full text-sm">
                        View All Notifications
                    </Button>
                </div>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>
</template>

<script setup lang="ts">
import {computed, onMounted, ref} from 'vue'
import {Bell, CreditCard, Mail, MailOpen, Server, Shield, Target, Users, X} from 'lucide-vue-next'
import Button from './ui/button.vue'
import Badge from './ui/badge.vue'
import DropdownMenu from "@/Revamp/Components/ui/DropdownMenu/DropdownMenu.vue";
import DropdownMenuTrigger from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuTrigger.vue";
import DropdownMenuContent from "@/Revamp/Components/ui/DropdownMenu/DropdownMenuContent.vue";

interface Notification {
    id: string
    title: string
    message: string
    type: 'system' | 'user' | 'tip' | 'payment' | 'security'
    severity: 'critical' | 'high' | 'medium' | 'low'
    read: boolean
    createdAt: string
    user?: {
        id: string
        name: string
        email: string
    }
}

// Reactive state
const notifications = ref<Notification[]>([])

// Generate mock notifications for dropdown
const generateNotifications = (): Notification[] => {
    return [
        {
            id: 'NOT001',
            title: 'New User Registration',
            message: 'John Doe has registered for a premium account',
            type: 'user',
            severity: 'low',
            read: false,
            createdAt: new Date(Date.now() - 1000 * 60 * 30).toISOString(), // 30 minutes ago
            user: {id: 'USR001', name: 'John Doe', email: 'john@example.com'}
        },
        {
            id: 'NOT002',
            title: 'Payment Received',
            message: 'KES 1,899 payment received from Jane Smith',
            type: 'payment',
            severity: 'medium',
            read: false,
            createdAt: new Date(Date.now() - 1000 * 60 * 60 * 2).toISOString(), // 2 hours ago
        },
        {
            id: 'NOT003',
            title: 'Security Alert',
            message: 'Multiple failed login attempts detected from IP 192.168.1.100',
            type: 'security',
            severity: 'critical',
            read: false,
            createdAt: new Date(Date.now() - 1000 * 60 * 60 * 4).toISOString(), // 4 hours ago
        },
        {
            id: 'NOT004',
            title: 'Tip Performance Update',
            message: 'Daily tip accuracy reached 78.5% - above target!',
            type: 'tip',
            severity: 'medium',
            read: true,
            createdAt: new Date(Date.now() - 1000 * 60 * 60 * 6).toISOString(), // 6 hours ago
        },
        {
            id: 'NOT005',
            title: 'System Maintenance',
            message: 'Scheduled maintenance completed successfully',
            type: 'system',
            severity: 'low',
            read: true,
            createdAt: new Date(Date.now() - 1000 * 60 * 60 * 12).toISOString(), // 12 hours ago
        }
    ]
}

// Computed properties
const unreadCount = computed(() =>
    notifications.value.filter(n => !n.read).length
)

const recentNotifications = computed(() =>
    notifications.value.slice(0, 10) // Show only recent 10 notifications
)

// Methods
const getNotificationIcon = (type: string) => {
    switch (type) {
        case 'system':
            return Server
        case 'user':
            return Users
        case 'tip':
            return Target
        case 'payment':
            return CreditCard
        case 'security':
            return Shield
        default:
            return Bell
    }
}

const getNotificationIconBg = (type: string) => {
    switch (type) {
        case 'system':
            return 'bg-blue-100 dark:bg-blue-900/20'
        case 'user':
            return 'bg-green-100 dark:bg-green-900/20'
        case 'tip':
            return 'bg-orange-100 dark:bg-orange-900/20'
        case 'payment':
            return 'bg-purple-100 dark:bg-purple-900/20'
        case 'security':
            return 'bg-red-100 dark:bg-red-900/20'
        default:
            return 'bg-gray-100 dark:bg-gray-900/20'
    }
}

const getNotificationIconColor = (type: string) => {
    switch (type) {
        case 'system':
            return 'text-blue-600'
        case 'user':
            return 'text-green-600'
        case 'tip':
            return 'text-orange-600'
        case 'payment':
            return 'text-purple-600'
        case 'security':
            return 'text-red-600'
        default:
            return 'text-gray-600'
    }
}

const formatTimeAgo = (dateString: string) => {
    const date = new Date(dateString)
    const now = new Date()
    const diffInMinutes = Math.floor((now.getTime() - date.getTime()) / (1000 * 60))

    if (diffInMinutes < 1) return 'Just now'
    if (diffInMinutes < 60) return `${diffInMinutes}m ago`
    if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)}h ago`
    return `${Math.floor(diffInMinutes / 1440)}d ago`
}

const handleNotificationClick = (notification: Notification) => {
    // Mark as read when clicked
    markAsRead(notification.id)

    // Handle navigation based on notification type
    console.log('Navigate to:', notification.type, notification.id)
}

const toggleRead = (notification: Notification) => {
    const index = notifications.value.findIndex(n => n.id === notification.id)
    if (index !== -1) {
        notifications.value[index].read = !notifications.value[index].read
    }
}

const markAsRead = (notificationId: string) => {
    const index = notifications.value.findIndex(n => n.id === notificationId)
    if (index !== -1) {
        notifications.value[index].read = true
    }
}

const markAllAsRead = () => {
    notifications.value.forEach(notification => {
        notification.read = true
    })
}

const removeNotification = (notificationId: string) => {
    notifications.value = notifications.value.filter(n => n.id !== notificationId)
}

const viewAllNotifications = () => {
    // Emit event to navigate to notifications page
    console.log('Navigate to notifications page')
    // You can emit an event here if needed for parent components
}

// Initialize data
onMounted(() => {
    notifications.value = generateNotifications()
})
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
