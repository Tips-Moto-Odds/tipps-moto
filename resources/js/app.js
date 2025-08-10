import './bootstrap';
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '/vendor/tightenco/ziggy';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import jQuery from 'jquery';
import {createPinia} from "pinia";
import '../scss/_index.scss'
import * as lucide from 'lucide-vue-next'

import dropdownComponents from './Revamp/Components/ui/DropdownMenu/dropdownLoader'
import avatarComponents from './Revamp/Components/ui/Avatar/avatarsLoader.js'

if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        navigator.serviceWorker.register("/sw.js");
    });
}

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

        app.component('Link', Link)

        Object.entries(dropdownComponents).forEach(([name, component]) => {
            app.component(name, component)
        })

        Object.entries(avatarComponents).forEach(([name, component]) => {
            app.component(name, component)
        })

        Object.entries(lucide).forEach(([name, component]) => {
            if (name === 'Link') {
                app.component('LucideLink', component); // Rename it
            } else {
                app.component(name, component);
            }
        });


        app.mount(el);

        return app;
    },
    progress: {
        color: '#4B5563',
    },
}).then(r => {
});








