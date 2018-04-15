import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        notifications: [],
        posts: [],
        wallPosts: [],
        auth_user: {}
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

        all_wall_posts(state) {
            return state.wallPosts
        },

        all_wall_posts_count(state) {
            return state.wallPosts.length
        }
    },

    mutations: {
        add_notification(state, notification) {
            state.notifications.push(notification)
        },

        add_post(state, post) {
            state.posts.push(post)
        },

        add_wall_post(state, wallPost) {
            state.wallPosts.push(wallPost)
        },

        add_auth_user_data(state, user) {
            state.auth_user = user;
        },

        update_post_likes(state, payload) {
            let likedPost = state.posts.find((post) =>{
               return post.id === payload.id;
            });

            likedPost.likes.push(payload.like);
        },

        unlike_post(state, payload) {
            let post = state.posts.find((p) =>{
                return p.id === payload.id;
            });

            let like = post.likes.find((l) =>{
                return l.id === payload.like_id
            });

            let index = post.likes.indexOf(like);

            post.likes.splice(index, 1);
        }
    },

});