<template>
    <div class="container">
        <div class="row">
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.get_feed()
        },

        methods: {
            get_feed() {
                this.$http.get('/feed')
                    .then((response) => {
                        response.body.forEach((post) =>{
                            this.$store.commit('add_post', post)
                        })
                    })
            }
        }
    }
</script>

<style>

</style>