
async function updateInfo(userForm) {
    try {
        await userForm.patch(route('UpdateUser', userForm.id))
    } catch (e) {
        console.log(e)
    }
}

async function updatePassword(securityForm,userForm) {

    try {
        await securityForm.patch(route('UpdatePassword', userForm.id))
    } catch (e) {
        console.log(e)
    }
}

export {
    updateInfo,
    updatePassword,
}
