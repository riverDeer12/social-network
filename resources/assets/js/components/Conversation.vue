<template>
    <div class="conversation">
        <h4>{{ contact ? contact.name : 'Select a contact from contacts list' }}</h4>
        <messages-feed :contact="contact" :messages="messages"></messages-feed>
        <new-message @send="send_message"></new-message>
    </div>
</template>

<script>
    import MessagesFeed from './MessagesFeed.vue';
    import NewMessage from './NewMessage.vue';

    export default {
        props: {
            contact: {
                type: Object,
            },
            messages: {
                type: Array,
                required: true,
            }
        },

        data() {
            return {
                messageText: ''
            }
        },

        components: {
            MessagesFeed,
            NewMessage
        },

        http: {root: '/root', headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')}},

        methods: {
            send_message(text) {
                if (!this.contact) {
                    return;
                }

                this.$http.post('/conversation/send_message', {
                    contact_id: this.contact.id,
                    message: text,
                }).then((response) => {
                    this.$emit('newmessage', response.body)
                })
            }
        }
    }
</script>

<style scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .conversation h4 {
        padding: 15px;
        margin: 0;
    }

</style>