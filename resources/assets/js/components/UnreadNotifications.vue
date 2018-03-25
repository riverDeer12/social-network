<template>
    <div>
        <a class="nav-link" href="/notifications">
            <span class="badge badge-success"> Notifications {{ all_notifications_count }} </span>
        </a>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_notifications()
        },

        computed: {
            all_notifications_count() {
                return this.$store.getters.all_notifications_count
            }
        },

        methods: {
            get_notifications() {
                this.$http.get('/get_notifications')
                    .then((notifications) => {
                        notifications.body.forEach((notification) => {
                            this.$store.commit('add_notification', notification)
                        })
                    })
            }
        }
    }

</script>

<style>

</style>