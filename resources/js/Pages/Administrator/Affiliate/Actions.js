const sendRequest = async (form, page) => {
    try {
        await form.post(route('subscribe'), {
            preserveScroll: true,
            onSuccess: function (response) {
                if (page.props.flash.error) {
                    alert(page.props.flash.error)
                } else if (page.props.flash.success) {
                    alert(page.props.flash.success)
                }

                $('#subscription_panel').fadeOut('fast',() => {
                    location.reload()
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

const unsubscribe = async (form, page) => {
    try {
        await form.post(route('unsubscribe'), {
            preserveScroll: true,
            onSuccess: function (response) {
                if (page.props.flash.error) {
                    alert(page.props.flash.error)
                } else if (page.props.flash.success) {
                    alert(page.props.flash.success)
                }

                $('#un_subscription_panel').fadeOut('fast',() => {
                    location.reload()
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}


const searchUserByID = async (id) => {
    return await axios.get('/api/users/' + id)
    .then(response => {
        console.log(response)
        return []
    })
}

export {
    searchUserByID,
    sendRequest,
    unsubscribe
}
