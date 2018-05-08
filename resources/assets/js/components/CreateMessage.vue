<template>
    <div>
        <div class="new-message-container">
            <div class="form-group message-container">
                <input type="text" class="form-control" placeholder="Start typing here..." v-model="messageText" @keyup.enter="sendMessage">
            </div>
            <div class="form-group send-container">
                <button class="btn btn-success" @click="sendMessage">Send</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                messageText: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    message: this.messageText,
                    user: 'Milan'
                });
                this.messageText = '';
            }
        }
    }
</script>

<style scoped>
    .new-message-container {
        display: flex;
        width: 100%;
    }

    .new-message-container input {
        flex: 1 auto;
        border-radius: 0;
    }

    .new-message-container button {
        border-radius: 0;
    }

    .message-container {
        width: 100%;
    }

    .send-container {
        width: 0;
    }
</style>