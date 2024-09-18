
async function updateInfo(userForm) {
    try {
        await userForm.patch(route('patchUser', userForm.id))
    } catch (e) {
        console.log(e)
    }
}

async function updatePassword(securityForm,userForm) {

    try {
        await securityForm.patch(route('patchPassword', userForm.id))
    } catch (e) {
        console.log(e)
    }
}

export {
    updateInfo,
    updatePassword,
}
