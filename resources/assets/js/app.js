import Vue from 'vue'

import App from './App.vue'
import router from './router/frist.js'
import axios from 'axios';

const app = new Vue({
    el: '#app',
    template: `<app></app>`,
    components: { App },
    router
})

