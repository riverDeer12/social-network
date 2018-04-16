<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <input type="text" class="form-control" @keyup="search" v-model="query" placeholder="Search...">
            </div>
        </div>
        <div class="dropdown col-md-6" style="max-height: 100px; overflow-y: auto;">
            <div class="list-group" v-if="results.length">
                <div class="list-group-item" v-for="user in results">
                    <a :href="'/profile/' + user.username"><img :src="user.avatar"
                                                                height="40px" width="40px">{{ user.name}}</a>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    let algoliasearch = require('algoliasearch');
    let client = algoliasearch('XMOONZHM6E', '58bc6ddeb90c6984bac559a455def7a9');
    let index = client.initIndex('users');

    export default {
        mounted() {

        },

        data() {
            return {
                query: '',
                results: []
            }
        },

        methods: {
            search() {
                index.search(this.query, (err, response) => {
                    this.results = response.hits
                });
            }
        }

    }
</script>

<style scoped>

</style>