/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

import VueRouter from "vue-router";
import Vuex from "vuex";
import axios from "axios";
import VueAxios from "vue-axios";
import VueSocialauth from "vue-social-auth";

import { routes } from "./routes";
import storeData from "./store/index";
import {
    google_client_id,
    google_client_secret,
    google_login_redirect,
} from "./config";

axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);
Vue.use(VueSocialauth, {
    providers: {
        google: {
            clientId: google_client_id,
            client_secret: google_client_secret,
            redirectUri: google_login_redirect,
        },
    },
});

const store = new Vuex.Store(storeData);

export const router = new VueRouter({
    base: "/",
    mode: "history",
    routes,
    store,
});

Vue.component(
    "app-header",
    require("./components/HeaderComponent.vue").default
);
Vue.component(
    "app-footer",
    require("./components/FooterComponent.vue").default
);

const app = new Vue({
    el: "#app",
    router,
});
