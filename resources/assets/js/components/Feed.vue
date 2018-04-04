<template>
    <div class="container">
        <p class="text-center" v-if="postsNumber == 0">
            No posts.
        </p>
        <p class="text-center" v-if="loading">
            Loading...
        </p>
        <div class="row spacing" v-for="post in posts">
            <div class="col-md-5 offset-4">
                <div class="card">
                    <div class="card-header">
                        <img class="post-user-image" :src="post.user.avatar">
                        <span>{{ post.user.name }}</span>
                    </div>
                    <div class="card-body text-center">{{ post.content }}</div>
                    <div class="card-footer">
                        <div class="float-left">
                            <likes></likes>
                        </div>
                        <div class="float-right">
                            <span>Posted on: {{ moment(post.created_at).fromNow() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let moment = require('moment');
    export default {
        mounted() {
            this.get_feed();
        },

        data() {
            return {
                moment: moment,
                loading: true
            }
        },

        computed: {
            posts() {
                return this.$store.getters.all_posts
            },
            postsNumber() {
                return this.$store.getters.all_posts_count
            }
        },

        methods: {
            get_feed() {
                this.loading = true;
                this.$http.get('/feed')
                    .then((response) => {
                        response.body.forEach((post) => {
                            this.$store.commit('add_post', post);
                            this.loading = false;
                        })
                    })
            }
        }
    }
</script>

<style>
    .spacing {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .post-user-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
</style>