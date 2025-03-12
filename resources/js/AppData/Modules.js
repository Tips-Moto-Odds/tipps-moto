import hasAccess from "@/HelperFunctions/getAccess.js";

const defaultGrouping = [
    {
        name: "Dashboard",
        modules: [
            {
                name: "Dashboard",
                link: route('dashboard'),
                supported: ['dashboard'],
                icon: "https://img.icons8.com/material-outlined/24/ffffff/dashboard-layout.png",
                accessLevel: 'Moderator'
            }
        ]
    },
    {
        name: "Manage",
        modules: [
            {
                name: "Accounts",
                link: route('dashboard.user.listUsers'),
                supported: ['dashboard.user.listUsers', 'dashboard.user.viewUsers'],
                icon: 'https://img.icons8.com/ios/50/ffffff/share_2.png',
                accessLevel: 'Moderator'
            },
            {
                name: "Matches",
                link: route('dashboard.matches.listMatches'),
                supported: ['dashboard.matches.listMatches', 'dashboard.matches.viewMatch', 'dashboard.matches.createMatch', 'dashboard.matches.updateMatch'],
                icon: 'https://img.icons8.com/ios-glyphs/30/ffffff/football2--v1.png',
                accessLevel: 'Guest'
            },
            {
                name: "Tips",
                link: route('dashboard.tips.listTips'),
                supported: ['dashboard.tips.listTips'],
                icon: 'https://img.icons8.com/ios/100/ffffff/tip.png',
                accessLevel: 'Guest'
            },
            {
                name: "Selections",
                link: route('dashboard.selection.listSelections'),
                supported: ['dashboard.selection.listSelections'],
                icon: 'https://img.icons8.com/fluency-systems-regular/50/ffffff/choose.png',
                accessLevel: 'Guest'
            },
            {
                name: "Transactions",
                link: route('dashboard.transactions.listTransactions'),
                supported: ['dashboard.transactions.listTransactions'],
                icon: 'https://img.icons8.com/glyph-neue/64/ffffff/refund-2.png',
                accessLevel: 'Guest'
            },
            {
                name: "Affiliate",
                link: route('dashboard.transactions.listTransactions'),
                supported: ['dashboard.transactions.listTransactions'],
                icon: 'https://img.icons8.com/external-nawicon-glyph-nawicon/64/ffffff/external-affiliate-seo-and-marketing-nawicon-glyph-nawicon.png',
                accessLevel: 'Guest'
            },
        ]
    },
    {
        name: "Administration",
        modules: [
            {
                name: "System",
                link: route('dashboard.system.index'),
                supported: ['dashboard.system.index'],
                icon:'https://img.icons8.com/ios-filled/50/ffffff/settings.png',
                accessLevel: 'Administration'
            },
            {
                name: "Model",
                link: route('dashboard'),
                active: 'model',
                icon: 'https://img.icons8.com/ios/50/ffffff/artificial-intelligence.png',
                accessLevel: 'Administration'
            },
            {
                name: "Account Types",
                link: route('dashboard.AccountTypes.ListAccountTypes'),
                icon: 'https://img.icons8.com/ios/50/ffffff/microsoft-teams-2019.png',
                accessLevel: 'Administration'
            }
        ]
    }
]

const get_routes = (account_type = null) => {
    let active_routes = []

    defaultGrouping.forEach(group => {
        let includedGroup = []

        group.modules.forEach(module => {
            if (hasAccess(account_type, module.accessLevel)) {
                includedGroup.push(module)
            }
        })

        if (includedGroup.length > 0) {
            active_routes.push({
                name: group.name,
                modules: includedGroup,
            })
        }
    })
    return active_routes
};


export {
    get_routes
};
