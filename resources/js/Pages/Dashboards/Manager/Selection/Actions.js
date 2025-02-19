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

                $('#subscription_panel').fadeOut('fast', () => {
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

                $('#un_subscription_panel').fadeOut('fast', () => {
                    location.reload()
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

const getPredictions = (predictionType, prediction) => {

    const predictionMap = {
        "1X_X2_12": {
            "1": "1/X",
            "0": "X/2",
            '-1': "1/2"
        },
        "1_X_2": {
            '1': "Home",
            '0': "Draw",
            '-1': "Away"
        },
        "GG-NG": {
            '1': "GG",
            '-1': "NG"
        }
    };


    // If the type exists in the map, return the correct prediction, otherwise return the raw value.
    return predictionMap[predictionType]?.[prediction] ?? prediction;
};


export {
    sendRequest,
    unsubscribe,
    getPredictions
}
