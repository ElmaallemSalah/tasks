import "./bootstrap";
import "../css/app.css";
import "@vuepic/vue-datepicker/dist/main.css";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

import {
    createApp,
    h,
} from "vue";

import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import Toast from "vue-toastification";

import { createInertiaApp } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";

import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const options = {
    position: "top-right",
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('VueDatePicker', VueDatePicker)
            .use(Toast, options)
            .mount(el);
    },
    progress: {
        delay: 0,
   
        // The color of the progress bar...
        color: 'red',
    },
});
