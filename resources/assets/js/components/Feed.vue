<template>
    <div class="container-fluid">
        <div class="text-center" v-if="loading">
            Loading...
        </div>
        <div class="text-center" v-if="postsNumber === 0">
            No posts.
        </div>
        <div class="row spacing" v-for="(post,index) in posts" :key="index">
            <div class="post-container">
                <div class="card">
                    <div class="card-header">
                        <img class="post-user-image" :src="post.user.avatar">
                        <span class="text-center">{{ post.user.name }}</span>
                    </div>
                    <div class="card-body text-center">
                        {{ post.content }}
                        <hr/>
                        <div class="float-left">
                            <like :id="post.id"></like>
                        </div>
                        <div class="float-right">
                            <span>Posted: {{ moment(post.created_at).fromNow() }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <post-comments :post_id="post.id"></post-comments>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Like from "./Like.vue";
    import PostComments from "./PostComments.vue";

    let moment = require("moment");
    export default {
        created() {
            this.get_feed();
        },

        data() {
            return {
                moment: moment,
                loading: true,
            };
        },

        computed: {
            posts() {
                return this.$store.getters.all_posts;
            },

            postsNumber() {
                return this.$store.getters.all_posts_count;
            }
        },

        components: {
            Like,
            PostComments
        },

        methods: {
            get_feed() {
                this.loading = true;
                this.$http.get("/feed").then(response => {
                    if (response.bodyText === "[]") {
                        this.loading = false;
                    }
                    response.body.forEach(post => {
                        this.$store.commit("add_post", post);
                        this.loading = false;
                    });
                });
            }
        }
    };
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

    .post-container {
        width: 100%;
    }
</style>