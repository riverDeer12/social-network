<template>
    <div class="container friends-container">
        <div class="row">
            <span class="card-header friends-header">Friends: {{ friends_count }}</span>
        </div>
        <div class="row">
        <span class="friend-badge friends-badge-container" v-for="friend in friends">
            <a :href="'/profile/' + friend.username"><img class="img-thumbnail friend-avatar-img" :src="friend.avatar"
                                                          alt="" width="40px;" height="40px;"> {{ friend.name }} </a>
        </span>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_friends();
        },

        props: ['user_id'],

        computed: {
            friends() {
                return this.$store.getters.all_friends
            },

            friends_count() {
                return this.$store.getters.all_friends_count
            }
        },

        methods: {
            get_friends() {
                this.$http.get('/my_friends/' + this.user_id)
                    .then((response) => {
                        response.body.forEach((friend) => {
                            this.$store.commit('add_friend', friend);
                        })
                    })
            }
        }
    }
</script>

<style>
    .row {
        margin: 0;
    }

    .friends-container {
        padding: 10px;
    }

    .friend-badge {
        margin: 5px;
    }

    .friend-avatar-img {
        border-radius: 25%;
    }

    .friends-header{
        width: 100%;
        text-align: center;
    }

    .friends-badge-container{
        padding: 10px;
    }
</style>