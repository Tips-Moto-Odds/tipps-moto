export default  [
    {
        name: "Dashboard",
        links: [
            {
                name: "Dashboard",
                link: route('dashboard'),
                active: 'dashboard',
                icon: "https://img.icons8.com/material-outlined/24/ffffff/dashboard-layout.png"
            }
        ]
    },
    {
        name: "Profile",
        links: [
            {
                name: "Account",
                link: route('ViewProfile'),
                active: 'Profile',
                icon: "https://img.icons8.com/ios/50/ffffff/guest-male.png"
            }
        ]
    },
    {
        name: "Manage",
        links: [
            {
                name: "Accounts",
                link: route('manage.accounts'),
                active: 'accounts',
                icon: 'https://img.icons8.com/ios/50/ffffff/share_2.png'
            },
            {
                name: "Football",
                link: route('football'),
                active: 'Football',
                icon: 'https://img.icons8.com/ios-glyphs/30/ffffff/football2--v1.png'
            },
            {
                name: "Tips",
                link: route('listTips'),
                active: 'tips',
                icon: 'https://img.icons8.com/ios/50/ffffff/two-tickets.png'
            },
            {
                name: "Transactions",
                link: route('dashboard'),
                active: 'transactions',
                icon: 'https://img.icons8.com/windows/32/ffffff/paper-money-1.png'
            },
            {
                name: "Notifications",
                link: route('dashboard'),
                active: 'notifications',
                icon: 'https://img.icons8.com/material-outlined/24/ffffff/push-notifications.png'
            },

        ]
    },
    {
        name: "Administration",
        links: [
            {
                name: "Model",
                link: route('dashboard'),
                active: 'model',
                icon: 'https://img.icons8.com/ios/50/ffffff/artificial-intelligence.png'
            },
            {
                name: "Account Types",
                link: route('ListAccountTypes'),
                active: 'AccountTypes',
                icon: 'https://img.icons8.com/ios/50/ffffff/microsoft-teams-2019.png'
            }
        ]
    }
]
