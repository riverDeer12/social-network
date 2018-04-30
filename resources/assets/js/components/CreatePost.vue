<template>
    <div class="container-fluid">
        <div class="row">
            <div class="form-group col-md-12">
            <textarea class="form-control" name="content" id="content" placeholder="enter post content"
                      v-model="content"></textarea>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success float-right" :disabled="disabledSubmit" @click="create_post()">
                Create new post
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },

        data() {
            return {
                content: '',
                disabledSubmit: true
            }
        },

        watch: {
            content() {
                if (this.content.length > 0)
                    this.disabledSubmit = false;
                else
                    this.disabledSubmit = true
            }
        },

        http: {root: '/root', headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}},

        methods: {
            create_post() {
                this.$http.post('/posts', {content: this.content})
                    .then((response) => {
                        this.content = '';
                        this.$swal({
                            type: 'success',
                            text: 'Your new post is successfully created',
                            confirmButtonColor: '#218838'
                        })
                    });
            }
        }
    }
</script>

<style>

</style>