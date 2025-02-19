
function getLevel(accountType) {

    switch (accountType) {
        case 'Guest':
            return 1
        case 'User':
            return 2
        case 'Moderator':
        case 'Manager':
            return 3
        case 'Administration':
            return 4
        case 'SuperAdministration':
            return 5
    }
}

export default function hasAccess(accountType, required) {
    let currentLevel = getLevel(accountType);
    let requiredLevel = getLevel(required);
    return currentLevel >= requiredLevel
}
