<template>
    <div class="container">
        <div class="row justify-content-center">
            <p class="text-center" v-if="loading">
                Loading...
            </p>
            <div class="form-group" v-if="!loading">
                <button class="btn btn-primary btn-lg" v-if="status == 0" @click="add_friend">Send friend request
                </button>
                <button class="btn btn-default btn-lg" disabled v-if="status == 'waiting'">Waiting for response
                </button>
                <button class="btn btn-primary btn-lg" v-if="status == 'pending'" @click="accept_friend">
                    Accept friend request
                </button>
                <span class="text-success" v-if="status == 'friends'">Friends</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/check_relationship_status/' + this.profile_user_id)
                .then((response) => {
                    this.status = response.body.status;
                    this.loading = false
                })
        },

        props: ['profile_user_id'],

        data() {
            return {
                status: ' ',
                loading: true
            }
        },

        methods: ({
            add_friend() {
                this.loading = true;
                this.$http.get('/add_friend/' + this.profile_user_id)
                    .then((response) => {
                        if (response.body == 1) {
                            this.status = 'waiting';
                            this.loading = false;
                            this.$swal({
                                title: 'Friend request sent!',
                                text: 'Wait for users response',
                                imageUrl: 'https://timitownsend51.files.wordpress.com/2016/11/waiting_cat-t2.jpg?w=400&h=200&crop=1',
                                imageWidth: 400,
                                imageHeight: 200,
                                animation: false
                            });

                        }
                    })
            },

            accept_friend() {
                this.loading = true;
                this.$http.get('/accept_friend/' + this.profile_user_id)
                    .then((response) => {
                        if (response.body == 1) {
                            this.status = 'friends';
                            this.loading = false;
                            this.$swal({
                                title: 'You are friends now!',
                                text: 'Feel free to contact your new friend',
                                imageUrl: 'https://posts-cdn.kueez.com/PrDLHP728KfKcZvG/image-29Nzgi1GKJwySv7P.png',
                                imageWidth: 400,
                                imageHeight: 200,
                                animation: false
                            });
                        }
                    })
            }
        })

    }
</script>
