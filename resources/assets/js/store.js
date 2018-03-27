import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        notifications: [],
        posts: []
    },

    getters: {
        all_notifications(state) {
            return state.notifications
        },

        all_notifications_count(state) {
            return state.notifications.length
        }
    },

    mutations: {
        add_notification(state, notification) {
            state.notifications.push(notification)
        },

        add_post(state, post) {
            state.posts.push(post)
        }
    },

});