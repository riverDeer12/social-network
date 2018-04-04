<template>
    <div class="container">
        <p class="text-center" v-if="wallPostsNumber == 0">
            No  wall posts.
        </p>
        <p class="text-center" v-if="loading">
            Loading...
        </p>
        <div class="row spacing" v-for="wallPost in wallPosts">
            <div class="col-md-5 offset-4">
                <div class="card">
                    <div class="card-body text-center">{{ wallPost.content }}</div>
                    <div class="card-footer">
                        <div class="float-left">
                            <img class="post-user-image" :src="wallPost.user.avatar">
                            <span>{{ wallPost.user.name }}</span>
                        </div>
                        <div class="float-right">
                            <span>Posted: {{ moment(wallPost.created_at).fromNow() }}</span>
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
            this.get_wall();
        },

        data() {
            return {
                moment: moment,
                loading: true
            }
        },

        computed: {
            wallPosts() {
                return this.$store.getters.all_wall_posts
            },

            wallPostsNumber(){
                return this.$store.getters.all_wall_posts_count
            }
        },

        props:['user_id'],

        methods: {
            get_wall() {
                this.loading = true;
                this.$http.get('/wall_posts/' + this.user_id)
                    .then((response) => {
                        response.body.forEach((wallPost) => {
                            this.$store.commit('add_wall_post', wallPost);
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