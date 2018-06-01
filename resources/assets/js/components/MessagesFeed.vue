<template>
    <div class="messages-feed" ref="feed">
        <ul v-if="contact">
            <li :class="`message${message.to === contact.id ? ' sent' : ' received'}`" v-for="message in messages"
                :key="message.id">
                <div class="message-text">
                    {{ message.message }}
                    <small class="message-time">{{ moment(message.created_at).fromNow() }}</small>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    let moment = require('moment');

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },

        data(){
          return{
              moment: moment,
          }
        },

        methods: {
            scroll_bottom() {
                setTimeout(() =>{
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },

        watch:{
            contact(contact){
                this.scroll_bottom();
            },
            messages(messages){
                this.scroll_bottom();
            }
        }
    }
</script>

<style scoped>
    .messages-feed {
        max-height: 500px;
        overflow-y: scroll;
        background-color: #dfdfdf;
        padding: 20px;
        height: 500px;
    }

    li {
        list-style-type: none;
        padding: 1px;
    }

    li.message {
        border-radius: 5px;
        padding: 5px;
        margin: 5px;
        box-shadow: 0 0 5px 0 #0e0303;
    }

    li.message.sent {
        float: right;
        text-align: left;
        background: #28a745;
        color: #ffffff;
        width: 50%;
        padding: 10px;
    }

    li.message.received {
        float: left;
        text-align: left;
        background: rgba(0, 0, 0, 0.43);
        color: #ffffff;
        width: 50%;
        padding: 10px;
    }

    .message-time{
        margin-top: 25px;
        float: right;
    }

</style>