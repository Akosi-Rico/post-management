import './bootstrap';
import "awesome-notifications/dist/index.js";
import "awesome-notifications/dist/style.css";
import '../css/custom.css';
import "lodash";
import Alpine from 'alpinejs';
import 'jquery';

window.Alpine = Alpine;

Alpine.start();


import { createApp }  from "vue";
import client  from "./components/section/client/post.vue";
import navbar  from "./components/layout/header.vue";
import profile from "./components/section/account/profile.vue";
const app = createApp({
    components: {
        client,
        navbar,
        profile
    }
});
app.mount("#app");