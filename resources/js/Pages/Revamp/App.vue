<template>
    <div class="flex h-screen bg-gray-50 dark:bg-black">
        <Sidebar
            :collapsed="sidebarCollapsed"
            @toggle="sidebarCollapsed = !sidebarCollapsed"
            :current-page="currentPage"
            @page-change="setCurrentPage"
        />
        <div
            :class="`flex-1 flex flex-col transition-all duration-300 ${sidebarCollapsed ? 'ml-16' : 'ml-64'} min-w-0`">
            <DashboardHeader
                :currentPage="currentPage"
                @page-change="setCurrentPage"
                :currentAdmin="currentAdmin"
            />

            <main class="flex-1 p-6 overflow-auto">
                <component :is="currentComponent" v-bind="currentProps"/>
            </main>
        </div>
        <!--        <Toaster />-->
    </div>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue'
import Sidebar from "@/Revamp/Components/Sidebar.vue";
import DashboardHeader from "@/Revamp/Components/DashboardHeader.vue";
import DashboardView from "@/Revamp/Components/DashboardView.vue";
import AccountsPage from '@/Revamp/Components/AccountsPage.vue'
// import MatchesPage from './components/MatchesPage.vue'
// import TipsPage from './components/TipsPage.vue'
// import SubscriptionsPage from './components/SubscriptionsPage.vue'
// import TransactionsPage from './components/TransactionsPage.vue'
// import NotificationsPage from './components/NotificationsPage.vue'
// import SettingsPage from './components/SettingsPage.vue'
// import ProfilePage from './components/ProfilePage.vue'
// import CustomerSupportPage from './components/CustomerSupportPage.vue'
// import Toaster from './components/ui/sonner.vue'

// Generate tips for a match
const generateTipsForMatch = () => {
    const tipTypes = [
        {type: '1', subType: 'Home Win', value: '1', riskLevel: 'mid', prediction: 'Home Win'},
        {type: 'X', subType: 'Draw', value: 'X', riskLevel: 'high', prediction: 'Draw'},
        {type: '2', subType: 'Away Win', value: '2', riskLevel: 'mid', prediction: 'Away Win'},
        {type: '1X', subType: 'Home or Draw', value: '1X', riskLevel: 'low', prediction: 'Home Win or Draw'},
        {type: '12', subType: 'Home or Away', value: '12', riskLevel: 'low', prediction: 'Home Win or Away Win'},
        {type: 'X2', subType: 'Draw or Away', value: 'X2', riskLevel: 'low', prediction: 'Draw or Away Win'},
        {type: 'Over 1.5', subType: 'Goals', value: 'Over 1.5', riskLevel: 'low', prediction: 'Over 1.5 Goals'},
        {type: 'Under 1.5', subType: 'Goals', value: 'Under 1.5', riskLevel: 'high', prediction: 'Under 1.5 Goals'},
        {type: 'Over 2.5', subType: 'Goals', value: 'Over 2.5', riskLevel: 'mid', prediction: 'Over 2.5 Goals'},
        {type: 'Under 2.5', subType: 'Goals', value: 'Under 2.5', riskLevel: 'mid', prediction: 'Under 2.5 Goals'},
        {type: 'Over 3.5', subType: 'Goals', value: 'Over 3.5', riskLevel: 'high', prediction: 'Over 3.5 Goals'},
        {type: 'GG', subType: 'Both Teams Score', value: 'GG', riskLevel: 'mid', prediction: 'Both Teams Score'},
        {type: 'NG', subType: 'Clean Sheet', value: 'NG', riskLevel: 'mid', prediction: 'Clean Sheet'}
    ]

    const winningStatuses = ['pending', 'won', 'lost', 'void']
    const winningStatusWeights = [0.25, 0.45, 0.25, 0.05] // 25% pending, 45% won, 25% lost, 5% void
    const riskLevels = ['low', 'mid', 'high']

    // Helper function to get weighted random status
    const getWeightedRandomStatus = () => {
        const rand = Math.random()
        let cumulativeWeight = 0

        for (let i = 0; i < winningStatuses.length; i++) {
            cumulativeWeight += winningStatusWeights[i]
            if (rand <= cumulativeWeight) {
                return winningStatuses[i]
            }
        }
        return winningStatuses[0]
    }

    // Randomly select 1-4 tips for each match
    const numTips = Math.floor(Math.random() * 4) + 1
    const selectedTips = []

    for (let i = 0; i < numTips; i++) {
        const tipIndex = Math.floor(Math.random() * tipTypes.length)
        const tip = tipTypes[tipIndex]
        selectedTips.push({
            id: i + 1,
            tipType: tip.type,
            subType: tip.subType,
            value: tip.value,
            prediction: tip.prediction,
            riskLevel: riskLevels[Math.floor(Math.random() * riskLevels.length)],
            winningStatus: getWeightedRandomStatus(),
            free: Math.random() > 0.6 // 40% chance of being free
        })
    }

    return selectedTips
}

// Helper function to create a Date object from date and time strings
const createDateTime = (dateStr, timeStr) => {
    // Convert "Jul 03 2025" and "12:00 PM" to a Date object
    const dateTimeStr = `${dateStr} ${timeStr}`
    return new Date(dateTimeStr)
}

// Generate match data with diverse leagues and teams
const generateMatches = () => {
    const leagues = [
        {name: 'English Premier League', country: 'England'},
        {name: 'Spanish La Liga', country: 'Spain'},
        {name: 'German Bundesliga', country: 'Germany'},
        {name: 'Italian Serie A', country: 'Italy'},
        {name: 'French Ligue 1', country: 'France'},
        {name: 'Dutch Eredivisie', country: 'Netherlands'},
        {name: 'Portuguese Primeira Liga', country: 'Portugal'},
        {name: 'Brazilian Serie A', country: 'Brazil'},
        {name: 'Argentine Primera División', country: 'Argentina'},
        {name: 'MLS', country: 'USA'},
        {name: 'Japanese J1 League', country: 'Japan'},
        {name: 'Australian A-League', country: 'Australia'},
        {name: 'Russian Premier League', country: 'Russia'},
        {name: 'Turkish Super Lig', country: 'Turkey'},
        {name: 'Belgian Pro League', country: 'Belgium'}
    ]

    const teamsByLeague = {
        'English Premier League': [
            {home: 'Manchester United', away: 'Liverpool'},
            {home: 'Arsenal', away: 'Chelsea'},
            {home: 'Manchester City', away: 'Tottenham'},
            {home: 'Newcastle United', away: 'Brighton'},
            {home: 'Aston Villa', away: 'West Ham'}
        ],
        'Spanish La Liga': [
            {home: 'Real Madrid', away: 'Barcelona'},
            {home: 'Atletico Madrid', away: 'Sevilla'},
            {home: 'Valencia', away: 'Villarreal'},
            {home: 'Real Sociedad', away: 'Athletic Bilbao'},
            {home: 'Real Betis', away: 'Celta Vigo'}
        ],
        'German Bundesliga': [
            {home: 'Bayern Munich', away: 'Borussia Dortmund'},
            {home: 'RB Leipzig', away: 'Bayer Leverkusen'},
            {home: 'Eintracht Frankfurt', away: 'Wolfsburg'},
            {home: 'Borussia Monchengladbach', away: 'Freiburg'},
            {home: 'Union Berlin', away: 'Hoffenheim'}
        ],
        'Italian Serie A': [
            {home: 'Juventus', away: 'Inter Milan'},
            {home: 'AC Milan', away: 'Napoli'},
            {home: 'AS Roma', away: 'Lazio'},
            {home: 'Atalanta', away: 'Fiorentina'},
            {home: 'Torino', away: 'Bologna'}
        ],
        'French Ligue 1': [
            {home: 'Paris Saint-Germain', away: 'Marseille'},
            {home: 'Monaco', away: 'Lyon'},
            {home: 'Lille', away: 'Rennes'},
            {home: 'Nice', away: 'Montpellier'},
            {home: 'Strasbourg', away: 'Nantes'}
        ],
        'Dutch Eredivisie': [
            {home: 'Ajax', away: 'PSV Eindhoven'},
            {home: 'Feyenoord', away: 'AZ Alkmaar'},
            {home: 'FC Utrecht', away: 'Twente'},
            {home: 'Vitesse', away: 'Go Ahead Eagles'},
            {home: 'Groningen', away: 'Heerenveen'}
        ],
        'Portuguese Primeira Liga': [
            {home: 'Benfica', away: 'Porto'},
            {home: 'Sporting CP', away: 'Braga'},
            {home: 'Vitoria Guimaraes', away: 'Boavista'},
            {home: 'Maritimo', away: 'Pacos de Ferreira'},
            {home: 'Famalicao', away: 'Santa Clara'}
        ],
        'Brazilian Serie A': [
            {home: 'Flamengo', away: 'Palmeiras'},
            {home: 'Corinthians', away: 'Sao Paulo'},
            {home: 'Santos', away: 'Gremio'},
            {home: 'Internacional', away: 'Fluminense'},
            {home: 'Atletico Mineiro', away: 'Botafogo'}
        ],
        'Argentine Primera División': [
            {home: 'Boca Juniors', away: 'River Plate'},
            {home: 'Racing Club', away: 'Independiente'},
            {home: 'San Lorenzo', away: 'Estudiantes'},
            {home: 'Velez Sarsfield', away: 'Lanus'},
            {home: 'Tigre', away: 'Newells Old Boys'}
        ],
        'MLS': [
            {home: 'LA Galaxy', away: 'LAFC'},
            {home: 'New York City FC', away: 'New York Red Bulls'},
            {home: 'Inter Miami', away: 'Orlando City'},
            {home: 'Portland Timbers', away: 'Seattle Sounders'},
            {home: 'Atlanta United', away: 'Charlotte FC'}
        ],
        'Japanese J1 League': [
            {home: 'Kashima Antlers', away: 'Urawa Red Diamonds'},
            {home: 'Yokohama F. Marinos', away: 'Kawasaki Frontale'},
            {home: 'Cerezo Osaka', away: 'Gamba Osaka'},
            {home: 'FC Tokyo', away: 'Tokyo Verdy'},
            {home: 'Nagoya Grampus', away: 'Vissel Kobe'}
        ],
        'Australian A-League': [
            {home: 'Sydney FC', away: 'Melbourne Victory'},
            {home: 'Melbourne City', away: 'Brisbane Roar'},
            {home: 'Adelaide United', away: 'Perth Glory'},
            {home: 'Wellington Phoenix', away: 'Western United'},
            {home: 'Newcastle Jets', away: 'Central Coast Mariners'}
        ],
        'Russian Premier League': [
            {home: 'Zenit St. Petersburg', away: 'Spartak Moscow'},
            {home: 'CSKA Moscow', away: 'Dynamo Moscow'},
            {home: 'Lokomotiv Moscow', away: 'Rubin Kazan'},
            {home: 'Krasnodar', away: 'Rostov'},
            {home: 'Ural', away: 'Sochi'}
        ],
        'Turkish Super Lig': [
            {home: 'Galatasaray', away: 'Fenerbahce'},
            {home: 'Besiktas', away: 'Trabzonspor'},
            {home: 'Basaksehir', away: 'Sivasspor'},
            {home: 'Antalyaspor', away: 'Alanyaspor'},
            {home: 'Gaziantep FK', away: 'Konyaspor'}
        ],
        'Belgian Pro League': [
            {home: 'Club Brugge', away: 'Anderlecht'},
            {home: 'Genk', away: 'Antwerp'},
            {home: 'Standard Liege', away: 'Gent'},
            {home: 'Charleroi', away: 'Mechelen'},
            {home: 'Oostende', away: 'Kortrijk'}
        ]
    }

    const matches = []
    const dates = [
        // June 2025 dates (for last month comparison)
        'Jun 01 2025', 'Jun 02 2025', 'Jun 03 2025', 'Jun 04 2025', 'Jun 05 2025', 'Jun 06 2025',
        'Jun 07 2025', 'Jun 08 2025', 'Jun 09 2025', 'Jun 10 2025', 'Jun 11 2025', 'Jun 12 2025',
        'Jun 13 2025', 'Jun 14 2025', 'Jun 15 2025', 'Jun 16 2025', 'Jun 17 2025', 'Jun 18 2025',
        'Jun 19 2025', 'Jun 20 2025', 'Jun 21 2025', 'Jun 22 2025', 'Jun 23 2025', 'Jun 24 2025',
        'Jun 25 2025', 'Jun 26 2025', 'Jun 27 2025', 'Jun 28 2025', 'Jun 29 2025', 'Jun 30 2025',
        // July 2025 dates (for current month)
        'Jul 01 2025', 'Jul 02 2025', 'Jul 03 2025', 'Jul 04 2025', 'Jul 05 2025', 'Jul 06 2025',
        'Jul 07 2025', 'Jul 08 2025', 'Jul 09 2025', 'Jul 10 2025', 'Jul 11 2025', 'Jul 12 2025',
        'Jul 13 2025', 'Jul 14 2025'
    ]
    const times = [
        '10:00 AM', '12:00 PM', '2:00 PM', '4:00 PM', '6:00 PM', '8:00 PM', '10:00 PM',
        '11:00 AM', '1:00 PM', '3:00 PM', '5:00 PM', '7:00 PM', '9:00 PM'
    ]
    const statuses = ['pending', 'live', 'completed', 'cancelled']

    // Generate 75 matches for better demo content
    for (let i = 0; i < 75; i++) {
        const league = leagues[Math.floor(Math.random() * leagues.length)]
        const teams = teamsByLeague[league.name]
        const teamPair = teams[Math.floor(Math.random() * teams.length)]
        const randomDate = dates[Math.floor(Math.random() * dates.length)]
        const randomTime = times[Math.floor(Math.random() * times.length)]
        const randomStatus = statuses[Math.floor(Math.random() * statuses.length)]

        const tipsData = generateTipsForMatch()
        const dateTime = createDateTime(randomDate, randomTime)

        matches.push({
            id: 6689 + i,
            league: league.name,
            homeTeam: teamPair.home,
            awayTeam: teamPair.away,
            date: randomDate,
            time: randomTime,
            tips: tipsData.length,
            tipsData: tipsData,
            status: randomStatus,
            dateTime: dateTime
        })
    }

    // Sort by dateTime in descending order (newest matches first)
    return matches.sort((a, b) => b.dateTime.getTime() - a.dateTime.getTime())
}

// Reactive state
const sidebarCollapsed = ref(false)
const currentPage = ref('dashboard')
const selectedTransaction = ref(null)

// Current admin user info (matches SettingsPage data)
const currentAdmin = ref({
    firstName: 'John',
    lastName: 'Kamau',
    email: 'john.kamau@tipsmoto.com',
    phone: '+254 712 345 678',
    role: 'Super Admin',
    avatar: '', // Empty string for fallback initials
    joinDate: 'Jan 2024',
    lastLogin: 'Today at 9:30 AM'
})

// Global state for matches - diverse dataset
const allMatches = ref(generateMatches())


// Default component for under construction pages
const UnderConstructionView = {
    template: `
    <div class="flex items-center justify-center h-64">
      <div class="text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
          {{ pageTitle }}
        </h2>
        <p class="text-gray-600 dark:text-gray-400">
          This page is under construction
        </p>
      </div>
    </div>
  `,
    props: {
        pageTitle: String
    }
}

// Computed properties for dynamic component rendering
const currentComponent = computed(() => {
    switch (currentPage.value) {
        case 'accounts':
            return AccountsPage
        case 'matches':
        // return MatchesPage
        case 'tips':
        // return TipsPage
        case 'subscriptions':
        // return SubscriptionsPage
        case 'transactions':
        // return TransactionsPage
        case 'notifications':
        // return NotificationsPage
        case 'settings':
        // return SettingsPage
        case 'profile':
        // return ProfilePage
        case 'support':
        // return CustomerSupportPage
        case 'dashboard':
            return DashboardView
        default:
            return UnderConstructionView
    }
})

const currentProps = computed(() => {
    switch (currentPage.value) {
        case 'matches':
            return {
                matches: allMatches.value,
                onAddMatch: handleAddMatch,
                onMatchSave: handleMatchSave,
                onTipsUpdate: handleTipsUpdate
            }
        case 'tips':
            return {
                matches: allMatches.value
            }
        case 'profile':
            return {
                currentAdmin: currentAdmin.value,
                onPageChange: setCurrentPage
            }
        case 'dashboard':
            return {
                matches: allMatches.value,
                onPageChange: setCurrentPage
            }
        default:
            const pageNames = {
                'marketing': 'Marketing',
                'affiliate': 'Affiliate',
                'system': 'System',
                'model': 'Model'
            }
            return {
                pageTitle: pageNames[currentPage.value] || currentPage.value.charAt(0).toUpperCase() + currentPage.value.slice(1)
            }
    }
})

// Methods
const setCurrentPage = (page) => {
    currentPage.value = page
}

// Handle adding a new match
const handleAddMatch = (newMatchData) => {
    // Generate a new ID (find the highest existing ID and add 1)
    const maxId = Math.max(...allMatches.value.map(m => m.id))
    const newId = maxId + 1

    // Create dateTime for sorting
    const dateTime = createDateTime(newMatchData.date, newMatchData.time)

    // Create the new match object
    const newMatch = {
        id: newId,
        league: newMatchData.league,
        homeTeam: newMatchData.homeTeam,
        awayTeam: newMatchData.awayTeam,
        date: newMatchData.date,
        time: newMatchData.time,
        tips: 0, // New matches start with 0 tips
        tipsData: [], // Empty tips array
        status: newMatchData.status,
        dateTime: dateTime
    }

    // Add the new match to the state
    allMatches.value = [...allMatches.value, newMatch]
        .sort((a, b) => b.dateTime.getTime() - a.dateTime.getTime())
}

// Handle match updates from the detail view
const handleMatchSave = (matchId, updatedFields) => {
    allMatches.value = allMatches.value.map(match => {
        if (match.id === matchId) {
            const updatedMatch = {...match, ...updatedFields}
            // If date or time was updated, recalculate dateTime
            if (updatedFields.date || updatedFields.time) {
                updatedMatch.dateTime = createDateTime(
                    updatedFields.date || match.date,
                    updatedFields.time || match.time
                )
            }
            return updatedMatch
        }
        return match
    }).sort((a, b) => b.dateTime.getTime() - a.dateTime.getTime()) // Re-sort after update
}

// Handle tips updates from the detail view
const handleTipsUpdate = (matchId, newTips) => {
    allMatches.value = allMatches.value.map(match =>
        match.id === matchId
            ? {...match, tips: newTips.length, tipsData: newTips}
            : match
    )
}

// Initialize data
onMounted(() => {
    console.log('Vue.js App initialized with', allMatches.value.length, 'matches')
})
</script>
