<template>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 ">User Accounts</h1>
                <p class="text-gray-600 ">Manage user accounts and their subscriptions</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <Button @click="exportToCSV" variant="outline" class="flex items-center gap-2">
                    <Download class="h-4 w-4"/>
                    Export CSV
                </Button>
                <Button @click="showAddDialog = true" class="flex items-center gap-2">
                    <Plus class="h-4 w-4"/>
                    Add User
                </Button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <Card class="p-6">
                <CardContent>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 ">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900  mt-2">
                                {{ totalUsers.toLocaleString() }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 ">
                            <Users class="h-6 w-6 text-blue-600"/>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <TrendingUp class="h-4 w-4 text-green-600 mr-1"/>
                        <span class="text-sm font-medium text-green-600">12.5%</span>
                        <span class="text-sm text-gray-500  ml-2">from last month</span>
                    </div>
                </CardContent>
            </Card>

            <Card class="p-6">
                <CardContent>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 ">Active Users</p>
                            <p class="text-3xl font-bold text-gray-900  mt-2">
                                {{ activeUsers.toLocaleString() }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 ">
                            <UserCheck class="h-6 w-6 text-green-600"/>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <TrendingUp class="h-4 w-4 text-green-600 mr-1"/>
                        <span class="text-sm font-medium text-green-600">8.2%</span>
                        <span class="text-sm text-gray-500  ml-2">from last month</span>
                    </div>
                </CardContent>
            </Card>

            <Card class="p-6">
                <CardContent>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 ">Premium Users</p>
                            <p class="text-3xl font-bold text-gray-900  mt-2">
                                {{ premiumUsers.toLocaleString() }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-orange-100 ">
                            <Crown class="h-6 w-6 text-orange-600"/>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <TrendingUp class="h-4 w-4 text-green-600 mr-1"/>
                        <span class="text-sm font-medium text-green-600">15.3%</span>
                        <span class="text-sm text-gray-500 ml-2">from last month</span>
                    </div>
                </CardContent>
            </Card>

            <Card class="p-6">
                <CardContent>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 ">New Today</p>
                            <p class="text-3xl font-bold text-gray-900  mt-2">
                                {{ newToday }}
                            </p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100 ">
                            <UserPlus class="h-6 w-6 text-purple-600"/>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <TrendingDown class="h-4 w-4 text-red-600 mr-1"/>
                        <span class="text-sm font-medium text-red-600">3.1%</span>
                        <span class="text-sm text-gray-500  ml-2">from yesterday</span>
                    </div>
                </CardContent>
            </Card>
        </div>

        <!-- Filters -->
        <Card class="p-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"/>
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search users by name, email, or phone..."
                        class="pl-10 w-full px-3 py-2 border border-gray-300  rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 bg-white "
                    />
                </div>

                <Select v-model="selectedStatus">
                    <SelectTrigger class="w-full sm:w-[180px]">
                        <SelectValue placeholder="All Status"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="">All Status</SelectItem>
                        <SelectItem value="active">Active</SelectItem>
                        <SelectItem value="inactive">Inactive</SelectItem>
                        <SelectItem value="suspended">Suspended</SelectItem>
                    </SelectContent>
                </Select>

                <Select v-model="selectedPlan">
                    <SelectTrigger class="w-full sm:w-[180px]">
                        <SelectValue placeholder="All Plans"/>
                    </SelectTrigger>
                    <SelectContent>
                        <SelectItem value="">All Plans</SelectItem>
                        <SelectItem value="free">Free</SelectItem>
                        <SelectItem value="basic">Basic</SelectItem>
                        <SelectItem value="premium">Premium</SelectItem>
                        <SelectItem value="pro">Pro</SelectItem>
                    </SelectContent>
                </Select>
            </div>
        </Card>

        <!-- Users Table -->
        <Card>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>User</TableHead>
                        <TableHead>Email</TableHead>
                        <TableHead>Phone</TableHead>
                        <TableHead>Plan</TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Joined</TableHead>
                        <TableHead class="text-right">Actions</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow
                        v-for="user in paginatedUsers"
                        :key="user.id"
                        class="hover:bg-gray-50 "
                    >
                        <TableCell>
                            <div class="flex items-center space-x-3">
                                <Avatar class="h-8 w-8">
                                    <AvatarImage v-if="user.avatar" :src="user.avatar" :alt="user.name"/>
                                    <AvatarFallback class="bg-orange-500 text-white text-sm">
                                        {{ user.name.split(' ').map(n => n[0]).join('') }}
                                    </AvatarFallback>
                                </Avatar>
                                <div>
                                    <div class="font-medium text-gray-900 ">{{ user.name }}</div>
                                    <div class="text-sm text-gray-500 ">ID: {{ user.id }}</div>
                                </div>
                            </div>
                        </TableCell>
                        <TableCell>
                            <div class="text-sm">{{ user.email }}</div>
                        </TableCell>
                        <TableCell>
                            <div class="text-sm">{{ user.phone }}</div>
                        </TableCell>
                        <TableCell>
                            <Badge :variant="getPlanVariant(user.plan)">
                                {{ user.plan }}
                            </Badge>
                        </TableCell>
                        <TableCell>
                            <Badge :variant="getStatusVariant(user.status)">
                                {{ user.status }}
                            </Badge>
                        </TableCell>
                        <TableCell>
                            <div class="text-sm text-gray-500">{{ user.joinedDate }}</div>
                        </TableCell>
                        <TableCell class="text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <Tooltip>
                                    <TooltipTrigger as-child>
                                        <Button
                                            @click="viewUserDetail(user)"
                                            variant="ghost"
                                            size="sm"
                                            class="h-8 w-8 p-0"
                                        >
                                            <Eye class="h-4 w-4"/>
                                        </Button>
                                    </TooltipTrigger>
                                    <TooltipContent>View Details</TooltipContent>
                                </Tooltip>

                                <Tooltip>
                                    <TooltipTrigger as-child>
                                        <Button
                                            @click="editUser(user)"
                                            variant="ghost"
                                            size="sm"
                                            class="h-8 w-8 p-0"
                                        >
                                            <Edit class="h-4 w-4"/>
                                        </Button>
                                    </TooltipTrigger>
                                    <TooltipContent>Edit User</TooltipContent>
                                </Tooltip>

                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child>
                                        <Button variant="ghost" size="sm" class="h-8 w-8 p-0">
                                            <MoreVertical class="h-4 w-4"/>
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent align="end">
                                        <DropdownMenuItem @click="suspendUser(user)">
                                            <UserX class="h-4 w-4 mr-2"/>
                                            {{ user.status === 'suspended' ? 'Unsuspend' : 'Suspend' }}
                                        </DropdownMenuItem>
                                        <DropdownMenuItem @click="resetPassword(user)">
                                            <Key class="h-4 w-4 mr-2"/>
                                            Reset Password
                                        </DropdownMenuItem>
                                        <DropdownMenuSeparator/>
                                        <DropdownMenuItem @click="deleteUser(user)" class="text-red-600">
                                            <Trash2 class="h-4 w-4 mr-2"/>
                                            Delete User
                                        </DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </div>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>

            <!-- Pagination -->
            <div class="flex items-center justify-between px-6 py-4 border-t border-gray-200 ">
                <div class="text-sm text-gray-700">
                    Showing {{ ((currentPage - 1) * usersPerPage) + 1 }} to
                    {{ Math.min(currentPage * usersPerPage, filteredUsers.length) }} of {{ filteredUsers.length }} users
                </div>
                <div class="flex items-center space-x-2">
                    <Button
                        @click="currentPage = Math.max(1, currentPage - 1)"
                        :disabled="currentPage === 1"
                        variant="outline"
                        size="sm"
                    >
                        Previous
                    </Button>

                    <div class="flex items-center space-x-1">
                        <Button
                            v-for="page in visiblePages"
                            :key="page"
                            @click="currentPage = page"
                            :variant="currentPage === page ? 'default' : 'outline'"
                            size="sm"
                            class="w-8 h-8 p-0"
                        >
                            {{ page }}
                        </Button>
                    </div>

                    <Button
                        @click="currentPage = Math.min(totalPages, currentPage + 1)"
                        :disabled="currentPage === totalPages"
                        variant="outline"
                        size="sm"
                    >
                        Next
                    </Button>
                </div>
            </div>
        </Card>

        <!-- User Detail View -->
        <UserDetailView
            v-if="selectedUser"
            :user="selectedUser"
            :open="showDetailView"
            @close="closeDetailView"
            @save="handleUserSave"
        />
    </div>
</template>

<script setup lang="ts">
import {ref, computed, onMounted} from 'vue'
import {
    Users,
    UserCheck,
    Crown,
    UserPlus,
    TrendingUp,
    TrendingDown,
    Search,
    Plus,
    Download,
    Eye,
    Edit,
    MoreVertical,
    UserX,
    Key,
    Trash2
} from 'lucide-vue-next'
import Button from './ui/button.vue'
import Badge from './ui/badge.vue'
import UserDetailView from './UserDetailsView.vue'
import {Card, CardContent} from './ui/Cards/cardsLoader'
import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from './ui/Table/tableLoader'
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from './ui/Select/selectLoader'
// import {DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuTrigger} from './ui/DropdownMenu/dropdownLoader'
import {Tooltip, TooltipContent, TooltipTrigger} from './ui/Tooltip/toolTipLoader'

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

// Reactive state
const searchQuery = ref('')
const selectedStatus = ref('')
const selectedPlan = ref('')
const currentPage = ref(1)
const usersPerPage = ref(50)
const selectedUser = ref<User | null>(null)
const showDetailView = ref(false)
const showAddDialog = ref(false)
const users = ref<User[]>([])

// Stats
const totalUsers = ref(2847)
const activeUsers = ref(2156)
const premiumUsers = ref(542)
const newToday = ref(23)

// Generate mock user data
const generateUsers = () => {
    const firstNames = [
        'John', 'Jane', 'Michael', 'Sarah', 'David', 'Lisa', 'Robert', 'Emily', 'James', 'Jennifer',
        'William', 'Amanda', 'Daniel', 'Jessica', 'Matthew', 'Ashley', 'Christopher', 'Brittany',
        'Anthony', 'Samantha', 'Mark', 'Elizabeth', 'Steven', 'Stephanie', 'Paul', 'Nicole',
        'Andrew', 'Rachel', 'Kenneth', 'Lauren', 'Kevin', 'Megan', 'Brian', 'Kimberly', 'George',
        'Mary', 'Edward', 'Patricia', 'Ronald', 'Linda', 'Timothy', 'Barbara', 'Jason', 'Susan'
    ]

    const lastNames = [
        'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez',
        'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Thomas', 'Taylor',
        'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson', 'White', 'Harris', 'Sanchez',
        'Clark', 'Ramirez', 'Lewis', 'Robinson', 'Walker', 'Young', 'Allen', 'King', 'Wright',
        'Scott', 'Torres', 'Nguyen', 'Hill', 'Flores', 'Green', 'Adams', 'Nelson', 'Baker'
    ]

    const plans = ['free', 'basic', 'premium', 'pro']
    const statuses = ['active', 'inactive', 'suspended']
    const domains = ['gmail.com', 'outlook.com', 'yahoo.com', 'hotmail.com', 'icloud.com']

    const mockUsers: User[] = []

    for (let i = 0; i < 150; i++) {
        const firstName = firstNames[Math.floor(Math.random() * firstNames.length)]
        const lastName = lastNames[Math.floor(Math.random() * lastNames.length)]
        const email = `${firstName.toLowerCase()}.${lastName.toLowerCase()}@${domains[Math.floor(Math.random() * domains.length)]}`
        const phone = `+254 ${Math.floor(700000000 + Math.random() * 99999999)}`
        const plan = plans[Math.floor(Math.random() * plans.length)]
        const status = statuses[Math.floor(Math.random() * statuses.length)]

        // Generate random join date in the last 2 years
        const joinDate = new Date()
        joinDate.setDate(joinDate.getDate() - Math.floor(Math.random() * 730))

        // Generate random last active date
        const lastActive = new Date()
        lastActive.setDate(lastActive.getDate() - Math.floor(Math.random() * 30))

        mockUsers.push({
            id: `USR${String(i + 1001).padStart(4, '0')}`,
            name: `${firstName} ${lastName}`,
            email,
            phone,
            plan,
            status,
            joinedDate: joinDate.toLocaleDateString(),
            lastActive: lastActive.toLocaleDateString(),
            totalSpent: Math.floor(Math.random() * 5000) + 100,
            subscriptionEndDate: plan !== 'free' ?
                new Date(Date.now() + Math.random() * 365 * 24 * 60 * 60 * 1000).toLocaleDateString() :
                undefined
        })
    }

    return mockUsers.sort((a, b) => new Date(b.joinedDate).getTime() - new Date(a.joinedDate).getTime())
}

// Computed properties
const filteredUsers = computed(() => {
    return users.value.filter(user => {
        const matchesSearch = !searchQuery.value ||
            user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            user.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
            user.phone.includes(searchQuery.value) ||
            user.id.toLowerCase().includes(searchQuery.value.toLowerCase())

        const matchesStatus = !selectedStatus.value || user.status === selectedStatus.value
        const matchesPlan = !selectedPlan.value || user.plan === selectedPlan.value

        return matchesSearch && matchesStatus && matchesPlan
    })
})

const totalPages = computed(() => {
    return Math.ceil(filteredUsers.value.length / usersPerPage.value)
})

const paginatedUsers = computed(() => {
    const start = (currentPage.value - 1) * usersPerPage.value
    const end = start + usersPerPage.value
    return filteredUsers.value.slice(start, end)
})

const visiblePages = computed(() => {
    const pages = []
    const start = Math.max(1, currentPage.value - 2)
    const end = Math.min(totalPages.value, start + 4)

    for (let i = start; i <= end; i++) {
        pages.push(i)
    }
    return pages
})

// Methods
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

const viewUserDetail = (user: User) => {
    selectedUser.value = user
    showDetailView.value = true
}

const closeDetailView = () => {
    selectedUser.value = null
    showDetailView.value = false
}

const editUser = (user: User) => {
    // Handle edit user
    console.log('Edit user:', user)
}

const suspendUser = (user: User) => {
    // Handle suspend/unsuspend user
    console.log('Suspend user:', user)
}

const resetPassword = (user: User) => {
    // Handle reset password
    console.log('Reset password for:', user)
}

const deleteUser = (user: User) => {
    // Handle delete user
    console.log('Delete user:', user)
}

const handleUserSave = (userId: string, updatedFields: any) => {
    users.value = users.value.map(user =>
        user.id === userId ? {...user, ...updatedFields} : user
    )
}

const exportToCSV = () => {
    const headers = ['ID', 'Name', 'Email', 'Phone', 'Plan', 'Status', 'Joined Date', 'Total Spent']
    const csvContent = [
        headers.join(','),
        ...filteredUsers.value.map(user => [
            user.id,
            `"${user.name}"`,
            user.email,
            user.phone,
            user.plan,
            user.status,
            user.joinedDate,
            user.totalSpent
        ].join(','))
    ].join('\n')

    const blob = new Blob([csvContent], {type: 'text/csv;charset=utf-8;'})
    const link = document.createElement('a')
    const url = URL.createObjectURL(blob)
    link.setAttribute('href', url)
    link.setAttribute('download', `users_${new Date().toISOString().split('T')[0]}.csv`)
    link.style.visibility = 'hidden'
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
}

// Initialize data
onMounted(() => {
    users.value = generateUsers()
})
</script>
