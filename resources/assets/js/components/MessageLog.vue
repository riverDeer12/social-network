<template>
    <div class="col-md-5">
        <div>
            <message v-for="message in messages" :message="message"></message>
        </div>
    </div>
</template>

<script>
    export default {
        props:['messages']
    }
</script>

<style>

</style>