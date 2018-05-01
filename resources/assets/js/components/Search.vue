<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 form-control">
                <input class="col-md-11 search-input" type="text" @keyup="search" v-model="query"
                       placeholder="Search for other users...">
                <a href="https://www.algolia.com/"><span><img
                        src="https://files.startupranking.com/startup/thumb/15195_ab7ab3df0baf45fe1ec2d53ed1bf6c06b39cb582_algolia_m.png"
                        width="30px" height="30px"></span></a>
            </div>
        </div>
        <div class="search-results-div" v-show="hiddenResults">
            <div class="list-group" v-if="results.length">
                <span class="list-group-item" v-for="user in results">
                    <a :href="'/profile/' + user.username"><img :src="user.avatar"
                                                                height="40px" width="40px"> {{ user.name}} </a>
                </span>
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
                hiddenResults: false,
                results: []
            }
        },

        watch: {
            query() {
                if (this.query.length > 0) {
                    this.hiddenResults = true;
                } else {
                    this.hiddenResults = false;
                }
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
    .search-results-div {
        overflow-y: auto;
        background: #fff;
        border: solid 1px #e6e6e6;
        border-radius: 3px;
        -webkit-box-shadow: 0 0 5px rgba(0, 0, 0, .0975);
        box-shadow: 0 0 5px rgba(0, 0, 0, .0975);
        display: block;
        left: 46%;
        margin-left: -121px;
        position: absolute;
        right: -12px;
        top: 62px;
        width: 280px;
        z-index: 9;
    }

    .search-input{
        border: none;
        padding: 3px;
    }
</style>