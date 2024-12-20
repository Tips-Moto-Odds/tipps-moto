import './bootstrap';
import '../css/app.css';
import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '/vendor/tightenco/ziggy';
import {Link} from "@inertiajs/vue3";
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import './bootstrap';
import jQuery from 'jquery';
import '../scss/_index.scss'
import {createPinia} from "pinia";

window.$ = jQuery;

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .provide('jQuery', jQuery)
            .component('Link', Link)

        app.mount(el);

        return app;
    },
    progress: {
        color: '#4B5563',
    },
}).then(r => {
});

