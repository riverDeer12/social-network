import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        notifications: [],
        posts: [],
        wallPosts: []
    },

    getters: {
        all_notifications(state) {
            return state.notifications
        },

        all_notifications_count(state) {
            return state.notifications.length
        },

        all_posts(state) {
            return state.posts
        },

        all_posts_count(state) {
            return state.posts.length
        },

        all_wall_posts(state){
            return state.wallPosts
        }
    },

    mutations: {
        add_notification(state, notification) {
            state.notifications.push(notification)
        },

        add_post(state, post) {
            state.posts.push(post)
        },

        add_wall_post(state, wallPost){
            state.wallPosts.push(wallPost)
        }
    },

});