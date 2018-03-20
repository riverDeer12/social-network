<template>
    <div>

    </div>
</template>

<script>
    export default {
        mounted(){
            this.listen()
        },

        props:['id'],

        methods:{
            listen(){
                Echo.private('App.User.' + this.id)
                    .notification((notification) =>{
                        this.$swal({
                            position: 'top-end',
                            type: 'info',
                            text: notification.name + notification.message,
                        });
                        document.getElementById('notification_sound').play();
                    })
            }
        }
    }
</script>

<style>

</style>