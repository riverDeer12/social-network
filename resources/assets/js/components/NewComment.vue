<template>
    <div>
        <textarea class="form-control" v-model="commentText" @keydown.enter="send" cols="30" rows="2" placeholder="New comment..."></textarea>
    </div>
</template>

<script>
export default {
    data(){
        return{
            commentText: ''
        };
    },

    methods:{
        send(event){
            event.preventDefault();
            if(this.commentText === ''){
                return;
            }

            this.$emit('sendcomment', this.commentText);
            this.commentText = '';
        }
    }

}
</script>

<style>
</style>
