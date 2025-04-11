
async function updateInfo(userForm) {
    try {
        await userForm.patch(route('UpdateUser', userForm.id))
    } catch (e) {
    }
}

async function updatePassword(securityForm,userForm) {

    try {
        await securityForm.patch(route('UpdatePassword', userForm.id))
    } catch (e) {
    }
}

export {
    updateInfo,
    updatePassword,
}
