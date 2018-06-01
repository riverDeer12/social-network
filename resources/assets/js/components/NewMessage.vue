<template>
    <div class="new-message">
        <textarea class="form-control" v-model="messageText" @keydown.enter="send" id="messageTextarea" cols="15"
                  rows="2"
                  placeholder="New message..."></textarea>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageText: '',
            }
        },

        methods: {
            send(event) {
                event.preventDefault();
                if (this.messageText === '') {
                    return;
                }

                this.$emit('send', this.messageText);
                this.messageText = '';
            }
        }
    }
</script>

<style scoped>
    #messageTextarea {
        width: 96%;
        margin: 10px;
    }
</style>