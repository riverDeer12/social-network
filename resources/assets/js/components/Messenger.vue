<template>
    <div class="messenger-div">
        <conversation :messages="messages" :contact="selectedContact" @newmessage="push_new_message"></conversation>
        <contacts-list :contacts="contacts" @selected="start_conversation"></contacts-list>
    </div>
</template>

<script>
import Conversation from "./Conversation.vue";
import ContactsList from "./ContactsList.vue";

export default {
  props: ["user_id"],

  data() {
    return {
      selectedContact: null,
      messages: [],
      contacts: []
    };
  },

  mounted() {
    Echo.private(`messages.${this.user_id}`).listen("NewMessage", event => {
      this.handle_incoming_message(event.message);
    });

    this.$http.get("/my_friends/" + this.user_id).then(response => {
      response.body.forEach(friend => {
        this.contacts.push(friend);
      });
    });
  },

  components: {
    Conversation,
    ContactsList
  },

  methods: {
    start_conversation(contact) {
      this.messages = [];
      this.$http.get(`/conversation/${contact.id}`).then(response => {
        this.selectedContact = contact;
        response.body.forEach(message => {
          this.messages.push(message);
        });
      });
    },

    push_new_message(message) {
      this.messages.push(message);
    },

    handle_incoming_message(message) {
      if (this.selectedContact && message.from === this.selectedContact.id) {
        this.push_new_message(message);
        return;
      }
    }
  }
};
</script>

<style scoped>
.messenger-div {
  display: flex;
  border: 1px solid #dfdfdf;
}
</style>