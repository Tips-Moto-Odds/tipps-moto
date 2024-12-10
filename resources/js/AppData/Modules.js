const defaultRoutes = [
    {
        name: "Dashboard",
        links: [
            {
                name: "Dashboard",
                link: route('dashboard'),
                supported: ['dashboard'],
                icon: "https://img.icons8.com/material-outlined/24/ffffff/dashboard-layout.png"
            }
        ]
    },
    {
        name: "Manage",
        links: [
            {
                name: "Accounts",
                link: route('dashboard.user.listUsers'),
                supported: ['dashboard.user.listUsers','dashboard.user.viewUsers'],
                icon: 'https://img.icons8.com/ios/50/ffffff/share_2.png'
            },
            {
                name: "Tips",
                link: route('dashboard.tips.listTips'),
                supported: ['dashboard.tips.listTips','viewTip'],
                icon: 'https://img.icons8.com/ios-glyphs/30/ffffff/football2--v1.png'
            },
            {
                name: "Transactions",
                link: route('ManageTransactions'),
                icon: 'https://img.icons8.com/windows/32/ffffff/paper-money-1.png'
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
                link: route('ManageAccountTypes'),
                icon: 'https://img.icons8.com/ios/50/ffffff/microsoft-teams-2019.png'
            }
        ]
    }
]

const get_routes = (account_type = null) => {
    return defaultRoutes;
}


export {
    get_routes
};
