import webpush from 'web-push';
import axios from 'axios';
import config from './ENV/env.js';

const [encodedPayload] = process.argv.slice(2);

webpush.setVapidDetails(
    config.vapid.email,
    config.vapid.publicKey,
    config.vapid.privateKey
);

const parseNotification = (payload) => {
    if (!payload) return config.defaultNotification;

    try {
        return JSON.parse(Buffer.from(payload, 'base64').toString('utf-8'));
    } catch {
        console.warn('⚠️ Invalid payload. Falling back to default notification.');
        return config.defaultNotification;
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
        await waitForLaravel(config.getSubscriptionEndpoint);

        const {data: subscriptions} = await axios.get(config.getSubscriptionEndpoint);

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
                        await axios.post(config.removeSubscriptionEndpoint, {endpoint: sub.endpoint});
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
