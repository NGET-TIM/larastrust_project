require('./bootstrap');

require('alpinejs');

// Default theme
import '@splidejs/vue-splide/css';


// or other themes
import '@splidejs/vue-splide/css/skyblue';
import '@splidejs/vue-splide/css/sea-green';


// or only core styles
import '@splidejs/vue-splide/css/core';

import { createApp } from 'vue';
import App from './App.vue';
import router from "./router";
import VueSplide from '@splidejs/vue-splide';



const app = createApp(App);
app.use(router);
app.use(VueSplide);
app.mount("#app");