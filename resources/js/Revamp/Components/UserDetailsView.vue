<template>
    <Dialog :open="open" @update:open="$emit('close')">
        <DialogContent class="max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
            <DialogHeader>
                <DialogTitle>User Details - {{ user.name }}</DialogTitle>
                <DialogDescription>
                    View and manage user account information
                </DialogDescription>
            </DialogHeader>

            <div class="flex-1 overflow-y-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Information -->
                    <div class="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle class="text-lg">Personal Information</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <Avatar class="h-16 w-16">
                                        <AvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name"/>
                                        <AvatarFallback class="bg-orange-500 text-white text-lg">
                                            {{ user.name.split(' ').map(n => n[0]).join('') }}
                                        </AvatarFallback>
                                    </Avatar>
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ user.name }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ user.email }}</p>
                                        <Badge :variant="getStatusVariant(user.status)">
                                            {{ user.status }}
                                        </Badge>
                                    </div>
                                </div>

                                <Separator/>

                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">User ID</label>
                                        <p class="font-mono">{{ user.id }}</p>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                        <p>{{ user.phone }}</p>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Plan</label>
                                        <Badge :variant="getPlanVariant(user.plan)">
                                            {{ user.plan }}
                                        </Badge>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Joined Date</label>
                                        <p>{{ user.joinedDate }}</p>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Last Active</label>
                                        <p>{{ user.lastActive }}</p>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Total Spent</label>
                                        <p class="font-semibold">KES {{ user.totalSpent.toLocaleString() }}</p>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Subscription Info -->
                        <Card v-if="user.subscriptionEndDate">
                            <CardHeader>
                                <CardTitle class="text-lg">Subscription Details</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">Current Plan</label>
                                        <p class="capitalize">{{ user.plan }}</p>
                                    </div>
                                    <div>
                                        <label class="font-medium text-gray-500 dark:text-gray-400">End Date</label>
                                        <p>{{ user.subscriptionEndDate }}</p>
                                    </div>
                                </div>

                                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <p class="text-sm text-blue-800 dark:text-blue-200">
                                        Subscription is active and will auto-renew
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- Actions & Stats -->
                    <div class="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle class="text-lg">Quick Actions</CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-3">
                                <Button @click="editUser" variant="outline" class="w-full justify-start">
                                    <Edit class="h-4 w-4 mr-2"/>
                                    Edit User Details
                                </Button>

                                <Button @click="resetPassword" variant="outline" class="w-full justify-start">
                                    <Key class="h-4 w-4 mr-2"/>
                                    Reset Password
                                </Button>

                                <Button @click="viewTransactions" variant="outline" class="w-full justify-start">
                                    <CreditCard class="h-4 w-4 mr-2"/>
                                    View Transactions
                                </Button>

                                <Button @click="contactUser" variant="outline" class="w-full justify-start">
                                    <MessageCircle class="h-4 w-4 mr-2"/>
                                    Send Message
                                </Button>

                                <Separator/>

                                <Button
                                    @click="toggleUserStatus"
                                    variant="outline"
                                    :class="user.status === 'suspended' ? 'text-green-600' : 'text-orange-600'"
                                    class="w-full justify-start"
                                >
                                    <UserX class="h-4 w-4 mr-2"/>
                                    {{ user.status === 'suspended' ? 'Unsuspend User' : 'Suspend User' }}
                                </Button>

                                <Button @click="deleteUser" variant="outline" class="w-full justify-start text-red-600">
                                    <Trash2 class="h-4 w-4 mr-2"/>
                                    Delete User
                                </Button>
                            </CardContent>
                        </Card>

                        <!-- Activity Summary -->
                        <Card>
                            <CardHeader>
                                <CardTitle class="text-lg">Activity Summary</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Login Sessions</span>
                                        <span class="font-semibold">{{ Math.floor(Math.random() * 50) + 10 }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Tips Accessed</span>
                                        <span class="font-semibold">{{ Math.floor(Math.random() * 200) + 50 }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Support Tickets</span>
                                        <span class="font-semibold">{{ Math.floor(Math.random() * 5) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Referrals</span>
                                        <span class="font-semibold">{{ Math.floor(Math.random() * 3) }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>

            <DialogFooter>
                <Button @click="$emit('close')" variant="outline">Close</Button>
                <Button @click="saveChanges">Save Changes</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import {
    Edit,
    Key,
    CreditCard,
    MessageCircle,
    UserX,
    Trash2
} from 'lucide-vue-next'
import button from './ui/button.vue'
import Badge from './ui/badge.vue'
import Separator from './ui/separator.vue'
import {Card, CardContent, CardHeader, CardTitle} from './ui/Cards/cardsLoader'
import Avatar from "@/Revamp/Components/ui/Avatar/Avatar.vue";
import AvatarImage from "@/Revamp/Components/ui/Avatar/AvatarImage.vue";
import AvatarFallback from "@/Revamp/Components/ui/Avatar/AvatarFallback.vue";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle
} from './ui/Dialog/dialogLoader'

interface User {
    id: string
    name: string
    email: string
    phone: string
    plan: string
    status: string
    joinedDate: string
    avatar?: string
    lastActive: string
    totalSpent: number
    subscriptionEndDate?: string
}

interface Props {
    user: User
    open: boolean
}

defineProps<Props>()

defineEmits<{
    close: []
    save: [userId: string, updatedFields: any]
}>()

// Methods
const getStatusVariant = (status: string) => {
    switch (status) {
        case 'active':
            return 'default'
        case 'suspended':
            return 'destructive'
        default:
            return 'secondary'
    }
}

const getPlanVariant = (plan: string) => {
    switch (plan) {
        case 'pro':
            return 'default'
        case 'premium':
            return 'secondary'
        case 'basic':
            return 'outline'
        default:
            return 'secondary'
    }
}

const editUser = () => {
    console.log('Edit user')
}

const resetPassword = () => {
    console.log('Reset password')
}

const viewTransactions = () => {
    console.log('View transactions')
}

const contactUser = () => {
    console.log('Contact user')
}

const toggleUserStatus = () => {
    console.log('Toggle user status')
}

const deleteUser = () => {
    console.log('Delete user')
}

const saveChanges = () => {
    console.log('Save changes')
}
</script>
