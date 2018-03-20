
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-resource');
require('vue-sweetalert2');
window.Vue = require('vue');
import Vue from 'vue';
import VueResource from 'vue-resource';
import VueSweetAlert from 'vue-sweetalert2';
Vue.use(VueResource);
Vue.use(VueSweetAlert);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('friend', require('./components/Friend.vue'));
Vue.component('notification', require('./components/Notification.vue'));

const app = new Vue({
    el: '#app'
});
