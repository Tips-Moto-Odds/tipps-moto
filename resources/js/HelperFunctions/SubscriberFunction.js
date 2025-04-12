function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    const rawData = atob(base64);

    return Uint8Array.from([...rawData].map(char => char.charCodeAt(0)));
}

async function subscribeToPush() {
    try {
        const permission = await Notification.requestPermission();

        if (permission !== 'granted') {
            alert('Push permission denied');
            return;
        }

        const registration = await navigator.serviceWorker.ready;

        const existingSubscription = await registration.pushManager.getSubscription();

        if (existingSubscription) {
            await existingSubscription.unsubscribe();
        }

        const vapidKey = import.meta.env.VITE_PUSH_PUBLIC_KEY;

        const subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(vapidKey)
        });

        await axios.post('/notifications/subscribe', subscription);
    } catch (e) {

    }
}

async function notifyAction(data) {

    await axios.post('/notifications/notify', {
        title: data.title,
        body: data.body
    });
}


export {
    subscribeToPush,
    notifyAction
};
