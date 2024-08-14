const admin_routes = [
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
                name: "Teams",
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
const management_routes = [
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
                name: "Teams",
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
]
const user_routes = [
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
]


const get_routes = (account_type = null) => {
    let routes = null;

    switch (account_type) {
        case "Administrator":
            routes =  admin_routes;
            break;
        case "Manager":
            routes =  management_routes;
            break;
        case "user":
            routes =  user_routes;
            break;
        default:
            routes =  user_routes;
            break;
    }

    return routes;
}


export {
    get_routes
};
