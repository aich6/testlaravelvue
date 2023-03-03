import { createApp } from 'vue';
import router from './router/router'
import './bootstrap';

import App from "./componenets/App.vue";

createApp(App).use(router).mount("#app");