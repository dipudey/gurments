require("./bootstrap");

import { App, plugin } from "@inertiajs/inertia-vue";
import Vue from "vue";
import VueMeta from "vue-meta";
import VueNoty from "vuejs-noty";
import VueSweetalert2 from "vue-sweetalert2";
import vueDebounce from "vue-debounce";
import route from "ziggy";
import vSelect from "vue-select";
import Select2 from 'v-select2-component';


Vue.component('Select2', Select2);
Vue.use(plugin);
Vue.use(VueMeta, { refreshOnceOnNavigation: true });
Vue.use(VueNoty, {
    layout: "topRight",
    timeout: 1000,
    progressBar: true
});
Vue.use(vueDebounce, {
    listenTo: "input",
    fireOnEmpty: true
});
Vue.use(VueSweetalert2);
Vue.component("v-select", vSelect);
Vue.mixin(require("./mixin.js").default);
Vue.prototype.$route = route;

const el = document.getElementById("app");

new Vue({
    render: h =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(el);
