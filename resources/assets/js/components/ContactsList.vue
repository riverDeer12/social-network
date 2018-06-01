<template>
    <div class="contacts-list">
        <ul>
            <li :class="{'selected' : index === selected}" v-for="(contact, index) in contacts"
                :key="contact.id" @click="selectContact(index, contact)">
                <div class="avatar">
                    <img class="avatar-image" :src="contact.avatar" :alt="contact.name">
                </div>
                <div class="contact-info">
                    <p class="contact-name">{{ contact.name }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selected: 0,
            }
        },

        props: ['contacts'],

        methods: {
            selectContact(index, contact) {
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
    }
</script>

<style scoped>
    .avatar {
        display: flex;
        flex: 1;
        align-items: center;
    }

    .avatar-image {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        margin: 0 auto;
    }

    .contacts-list {
        flex: 2;
    }

    .contact-info{
        flex: 3;
        font-size: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-info p{
        margin: 0;
    }

    ul {
        list-style: none;
        max-height: 500px;
        padding-left: 0;
        overflow: hidden;
        border-left: 1px solid #dfdfdf;
    }

    li {
        display: flex;
        padding: 2px;
        height: 80px;
        position: relative;
        cursor: pointer;
    }

    li.selected{
        background: #dfdfdf;
    }
</style>