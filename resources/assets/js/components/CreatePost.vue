<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                Wanna create a new post?
            </div>
            <div class="card-body">
                <div class="form-group">
                    <textarea class="form-control" name="content" id="content"
                              placeholder="enter post content" v-model="content"></textarea>
                </div>
            </div>

            <div class="card-footer">
                <div class="form-group">
                    <button class="btn btn-success float-right" :disabled="disabledSubmit" @click="create_post()">
                        Create new post
                    </button>
                </div>
            </div>
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
                    })
            }
        }
    }
</script>

<style>

</style>