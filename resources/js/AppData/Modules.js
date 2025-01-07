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
                name: "Matches",
                link: route('dashboard.matches.listMatches'),
                supported: ['dashboard.matches.listMatches','dashboard.matches.viewMatch','dashboard.matches.createMatch','dashboard.matches.updateMatch'],
                icon: 'https://img.icons8.com/ios-glyphs/30/ffffff/football2--v1.png'
            },
            {
                name: "Tips",
                link: route('dashboard.tips.listTips'),
                supported: ['dashboard.tips.listTips'],
                icon: 'https://img.icons8.com/ios/100/ffffff/tip.png'
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
                link: route('dashboard.AccountTypes.ListAccountTypes'),
                icon: 'https://img.icons8.com/ios/50/ffffff/microsoft-teams-2019.png'
            }
        ]
    }
]

const get_routes = (account_type = null) => {
    let routes = [...defaultRoutes];

    switch (account_type) {
        case 'Guest':
            routes = routes.map(route => {
                if (route.name === "Manage") {
                    return {
                        name: "Manage",
                        links: route.links.filter(link => link.name === "Tips")
                    };
                } else if (route.name === "Dashboard" || route.name === "Administration") {
                    return null;
                }
                return route;
            }).filter(route => route !== null);
            break;
        case 'User':
            break;
        case 'Moderator':
            break;
        case 'Manager':
            break;
        case 'Administration':
            break;
        case 'SuperAdministration':
            break;
        default:
            break;
    }

    return routes;
};


export {
    get_routes
};
