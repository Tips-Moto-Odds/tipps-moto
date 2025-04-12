export default {
    getSubscriptionEndpoint: 'http://127.0.0.1:8000/api/get-subscriptions',
    removeSubscriptionEndpoint: 'http://127.0.0.1:8000/api/remove-subscription',

    vapid: {
        publicKey: 'BORS8alowof9E57sp3vATJEqHEOmiOhA_HOm_h6-faMspQr8xc0ST6UzTThVNa27LP_oNfE90TA0bUI6UvQ6sok',
        privateKey: '_EPr6Sv5h7QAEDcrlcEHkaNhaa230offBVtZGLpxplA',
        email: 'mailto:kimmwaus@gmail.com',
    },

    defaultNotification: {
        title: '🔥 TipsMoto Alert',
        body: 'Win with us',
    },
};
