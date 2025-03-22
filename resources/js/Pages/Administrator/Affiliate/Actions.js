const searchUserByID = async (id) => {
    return await axios.get('/api/users/' + id)
        .then(response => {
            return response.data
        }).catch(error => {
            alert(error)
        })
}

const addAffiliate = async (id) => {
    axios.post('/api/affiliates', {
        user_id: id
    })
    .then(response => {
        return response.data
    }).catch(error => {
        alert(error)
    })
}

export {
    searchUserByID,
    addAffiliate
}
