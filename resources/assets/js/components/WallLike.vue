<template>
    <div>
        <button class="btn btn-success" v-if="!auth_user_liked_wall_post" @click="like_wall_post()">
            <img src="https://use.fontawesome.com/releases/v5.0.10/svgs/regular/thumbs-up.svg" width="20px"
                 height="20px"> Like
        </button>
        <button class="btn btn-warning" v-else @click="unlike_wall_post()">
            <img src="https://use.fontawesome.com/releases/v5.0.10/svgs/regular/thumbs-down.svg" width="20px"
                 height="20px"> Unlike
        </button>
        <a class="btn btn-link" data-toggle="modal" :data-target="'#likersModal'+this.id">
            <span class="btn btn-default" v-if="likers.length !== 0"><img
                    src="https://use.fontawesome.com/releases/v5.0.10/svgs/regular/thumbs-up.svg" width="20px"
                    height="20px">
                {{ likers.length }}
            </span>
        </a>

        <div class="modal fade" :id="'likersModal'+this.id" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">List of likers</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(like,index) in wall.likes" :key="index">
                                <a :title="like.user.name" :href="'/profile/' + like.user.username">
                                    <img :src="like.user.avatar" height="40px" width="40px">
                                    <span>{{ like.user.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },

        props: ["id"],

        data() {
            return {
                dataTarget: '#likersModal' + this.id
            }
        },

        computed: {
            likers() {
                let likers = [];
                this.wall.likes.forEach(like => {
                    likers.push(like.user.id);
                });

                return likers;
            },

            auth_user_liked_wall_post() {
                let check_index = this.likers.indexOf(this.$store.state.auth_user.id);

                if (check_index === -1) {
                    return false;
                } else {
                    return true;
                }
            },

            wall() {
                return this.$store.state.wall.find(wall => {
                    return wall.id === this.id;
                });
            }
        },

        methods: {
            like_wall_post() {
                this.$http.get("/like_post/" + this.id).then(response => {
                    this.$store.commit("update_wall_post_likes", {
                        id: this.id,
                        like: response.body
                    });
                });

                this.$swal({
                    type: "success",
                    position: "bottom-left",
                    text: "Wall post liked",
                    showConfirmButton: false,
                    timer: 3000
                });
            },

            unlike_wall_post() {
                this.$http.get("/unlike_post/" + this.id).then(response => {
                    this.$store.commit("unlike_wall_post", {
                        id: this.id,
                        like_id: response.body
                    });
                });
            }
        }
    };
</script>

<style>
</style>