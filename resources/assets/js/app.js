/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-resource');
require('vue-sweetalert2');
require('moment');
window.Vue = require('vue');

import Vue from 'vue';
import VueResource from 'vue-resource';
import VueSweetAlert from 'vue-sweetalert2';
import Moment from 'moment';

Vue.use(VueResource);
Vue.use(VueSweetAlert);
Vue.use(Moment);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('init', require('./components/Init.vue'));
Vue.component('friend', require('./components/Friend.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('unread-notifications', require('./components/UnreadNotifications.vue'));
Vue.component('create-post', require('./components/CreatePost.vue'));
Vue.component('feed', require('./components/Feed.vue'));
Vue.component('like', require('./components/Like.vue'));
Vue.component('wall-like', require('./components/WallLike.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('wall', require('./components/Wall.vue'));
Vue.component('my-friends', require('./components/MyFriends.vue'));

import { store } from "./store";

const app = new Vue({
    el: '#app',
    store // shortly typed from store: store ES6
});
