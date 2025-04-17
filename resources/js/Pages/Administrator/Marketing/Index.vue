<script setup>
import {onMounted, watch} from 'vue'
import {useForm} from '@inertiajs/vue3'
import {debounce} from 'lodash'

import Pagination from '@/AppComponents/Global/Pagination.vue'
import DashboardLayout from '@/Layouts/AdministrationLayout/DashboardLayout.vue'
import FilterSection from '@/AppComponents/Dashbboard/FilterSection.vue'
import SideLayout from '@/AppComponents/Dashbboard/SideLayout.vue'
import {openSideBar} from '@/HelperFunctions/modalControl.js'

const props = defineProps(['MarketingData', 'filter', 'search'])

// Form state including search & segmentation
const pageController = useForm({
    search: props.search ?? '',
    filter: {
        segmentation: props.filter?.segmentation ?? ''
    }
})

// Autofocus on mount
onMounted(() => {
    if (props.search != null) {
        setTimeout(() => document.getElementById('search')?.focus(), 100)
    }
})

// Handle filter or search changes
watch(() => [
    pageController.search,
    pageController.filter.segmentation
], debounce(() => {
    fetchData()
}, 500))


// Fetch function using current form state
const fetchData = () => {
    pageController.get(route('dashboard.Marketing.listMarketing'), {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        only: ['MarketingData']
    })
}

const exportCSV = () => {
    const query = new URLSearchParams({
        search: pageController.search,
        'filter[segmentation]': pageController.filter.segmentation
    }).toString()

    const url = `${route('dashboard.Marketing.export')}?${query}`

    const anchor = document.createElement('a')
    anchor.href = url
    anchor.target = '_blank' // ✅ opens in new tab
    anchor.download = ''     // 👈 not strictly needed for CSV streams, but good practice

    document.body.appendChild(anchor)
    anchor.click()
    document.body.removeChild(anchor)
}

</script>


<template>
    <DashboardLayout page-heading="Marketing" title="Marketing">
        <template v-slot:side>
            <SideLayout title="Filter List" @close="openSideBar">
                <div class="container py-[20px]">
                    <ul class="p-0">
                        <li class="p-0">
                            <label class="text-white">Segmentation Filter</label>
                            <select v-model="pageController.filter.segmentation">
                                <option value="">Don't Segment</option>
                                <option value="not_bought">Not Bought</option>
                                <option value="bough_once">Bought Once</option>
                                <option value="bought_at_least_once">Bought More than Once</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </SideLayout>
        </template>

        <div class="flex gap-3 px-[10px]">
            <div class="app-panel w-full">
                <div class="app-panel-heading flex justify-between items-center">
                    <h4>All Marketing</h4>
                    <FilterSection @export="exportCSV"/>
                </div>
                <table class="text-white w-full mb-[20px] table-sm">
                    <thead class="h-[50px]">
                    <tr class="text-left border-b-[2px] text-xs">
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Purchases</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="user in MarketingData.data" :key="user.id">
                        <Link :href="route('dashboard.user.viewUsers', [user.id])" as="tr">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.phone }}</td>
                            <td>{{ user.successful_txn_count }}</td>
                        </Link>
                    </template>
                    </tbody>
                </table>
                <Pagination :pagination="MarketingData.links"/>
            </div>
        </div>
    </DashboardLayout>
</template>

