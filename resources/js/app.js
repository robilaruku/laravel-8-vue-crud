window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './router'
import Toasted from 'vue-toasted';


Vue.use(Toasted)
Vue.use(VueRouter);


Vue.component('navigation', require('./components/Navigation.vue').default);

const app = new Vue({
    el: '#robi',
    router: new VueRouter(routes),
});