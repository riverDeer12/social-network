<template>
    <div class="container">
        <p class="text-center" v-if="loading">
            Loading...
        </p>
        <p class="text-center" v-if="wall_count === 0">
            No posts.
        </p>
        <div class="row spacing" v-for="wall_post in wall">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <img class="post-user-image" :src="wall_post.user.avatar">
                        <span>{{ wall_post.user.name }}</span>
                    </div>
                    <div class="card-body text-center">{{ wall_post.content }}</div>
                    <div class="card-footer">
                        <div class="float-left">
                            <wall-like :id="wall_post.id"></wall-like>
                        </div>
                        <div class="float-right">
                            <span>Posted: {{ moment(wall_post.created_at).fromNow() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let moment = require('moment');
    import WallLike from './WallLike';
    export default {
        created(){
            this.get_wall();
        },

        props:['user_id'],

        data() {
            return {
                moment: moment,
                loading: true
            }
        },

        computed: {
            wall() {
                return this.$store.getters.wall
            },

            wall_count() {
                return this.$store.getters.wall_count
            },

        },

        components:{
          WallLike
        },

        methods: {
            get_wall() {
                this.loading = true;
                this.$http.get('/wall/' + this.user_id)
                    .then((response) => {
                        response.body.forEach((wall_post) => {
                            this.$store.commit('add_wall_post', wall_post);
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