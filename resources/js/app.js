
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./swal');

window.Vue = require('vue');

// npm install vuelidate --save
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

// npm install vue-loading-overlay --save
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
Vue.component('loading', Loading);

import VueLoader from './components/VueLoader';
Vue.component('vue-loader', VueLoader);

import RequiredLabel from './components/RequiredLabel.vue';
Vue.component('required-label', RequiredLabel);

import helpers from './helpers';
window.helpers = helpers;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from './App.vue'; 

import router from './routes';
import store from './store';

new Vue({
    el: '#app',
    router,
    store,
    components: {
        'vue-app': App,
    },
    data() {
       return {

       }
    },
    created() {

    }
});