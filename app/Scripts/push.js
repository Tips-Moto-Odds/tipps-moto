import webpush from 'web-push';
import axios from 'axios';

const [encodedPayload] = process.argv.slice(2);

const DEFAULT_NOTIFICATION = {
    title: '🔥 TipsMoto Alert',
    body: 'Win with us',
};

const getSubscriptionEndpoint = 'http://127.0.0.1:8000/api/get-subscriptions';
const removeSubscriptionEndpoint = 'http://127.0.0.1:8000/api/remove-subscription';

const vapidKeys = {
    publicKey: 'BORS8alowof9E57sp3vATJEqHEOmiOhA_HOm_h6-faMspQr8xc0ST6UzTThVNa27LP_oNfE90TA0bUI6UvQ6sok',
    privateKey: '_EPr6Sv5h7QAEDcrlcEHkaNhaa230offBVtZGLpxplA',
};

webpush.setVapidDetails(
    'mailto:kimmwaus@gmail.com',
    vapidKeys.publicKey,
    vapidKeys.privateKey
);

const parseNotification = (payload) => {
    if (!payload) return DEFAULT_NOTIFICATION;

    try {
        return JSON.parse(Buffer.from(payload, 'base64').toString('utf-8'));
    } catch (err) {
        console.warn('⚠️ Invalid payload. Falling back to default notification.');
        return DEFAULT_NOTIFICATION;
    }
};

const waitForLaravel = async (url, retries = 5, delay = 1000) => {
    for (let attempt = 1; attempt <= retries; attempt++) {
        try {
            await axios.get(url);
            return;
        } catch {
            console.log(`⏳ Laravel not ready. Retry ${attempt}/${retries}...`);
            await new Promise(res => setTimeout(res, delay));
        }
    }
    throw new Error('Laravel server not responding after retries.');
};

(async () => {
    const notification = parseNotification(encodedPayload);

    try {
        await waitForLaravel(getSubscriptionEndpoint);

        const {data: subscriptions} = await axios.get(getSubscriptionEndpoint);

        for (const sub of subscriptions) {
            const pushSubscription = {
                endpoint: sub.endpoint,
                keys: {
                    p256dh: sub.p256dh,
                    auth: sub.auth,
                },
            };

            try {
                await webpush.sendNotification(pushSubscription, JSON.stringify(notification));
                console.log('✅ Push sent to:', sub.endpoint);
            } catch (err) {
                console.error('❌ Push error:', err.statusCode, err.body);

                if ([404, 410].includes(err.statusCode)) {
                    try {
                        await axios.post(removeSubscriptionEndpoint, {endpoint: sub.endpoint});
                        console.log('🗑️ Removed stale subscription:', sub.endpoint);
                    } catch (removeErr) {
                        console.error('❌ Cleanup failed:', removeErr.message);
                    }
                }
            }
        }

        console.log('✅ All push tasks complete');
        process.exit(0);
    } catch (err) {
        console.error('❌ Fetch error:', err.message);
        process.exit(1);
    }
})();
