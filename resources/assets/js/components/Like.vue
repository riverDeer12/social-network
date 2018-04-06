<template>
    <div>
        <button class="btn btn-success">
            Like
        </button>
        <button class="btn btn-warning">
            Unlike
        </button>
    </div>

</template>

<script>
    export default {
        mounted() {

        },

        props: ['id'],

        computed:{
            post(){
                return this.$store.state.posts.find((post) =>{
                    return post.id === this.id
                })
            }
        }
    }
</script>

<style>

</style>