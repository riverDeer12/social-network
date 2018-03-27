<template>
    <div class="container">
        <div class="row spacing" v-for="post in posts">
            <div class="col-md-5 offset-4">
                <div class="card">
                    <div class="card-body text-center">{{ post.content }}</div>
                    <div class="card-footer">
                        <div class="float-left">
                            <img class="post-user-image" :src="post.user.avatar">
                            <span>{{ post.user.name }}</span>
                        </div>
                        <div class="float-right">
                            <span>Posted: {{ moment(post.created_at).fromNow() }}</span>
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

            // checking for new posts every 5 seconds
            setInterval(function () {
                this.get_feed();
            }.bind(this), 5000);
        },

        data() {
            return {
                moment: moment
            }
        },

        computed: {
            posts() {
                return this.$store.getters.all_posts
            }
        },

        methods: {
            get_feed() {
                this.$http.get('/feed')
                    .then((response) => {
                        response.body.forEach((post) => {
                            this.$store.commit('add_post', post)
                        }).bind(this);
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