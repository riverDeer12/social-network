<template>
    <div class="card message-container">
        <div class="card-header">
            <p>{{ message.message }}</p>
        </div>
        <div class="card-body">
            <small class="float-right">{{ message.user }}</small>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>

<style scoped>
    .message-container {
        margin: 10px;
    }
</style>