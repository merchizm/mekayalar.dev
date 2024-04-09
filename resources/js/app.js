import './bootstrap';
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

// layout and global css
import MainLayout from "./Layouts/MainLayout.vue";
import "../sass/app.scss";

createInertiaApp({
    title: title => `${title} - Meriç Enes Kayalar`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || MainLayout
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
