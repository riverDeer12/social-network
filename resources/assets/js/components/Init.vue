<template>
    <div>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_auth_user_data()
        },

        methods: {
            get_auth_user_data() {
                this.$http.get('/get_auth_user_data')
                    .then((response) => {
                        this.$store.commit('add_auth_user_data', response.body)
                    })
            }
        }

    }
</script>

<style>

</style>