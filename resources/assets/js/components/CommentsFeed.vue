<template>
    <div>
        <div class="card spacing" v-for="(comment, index) in comments" :key="index">
            <div class="card-header">
                <span>{{ comment.user.name }}</span>
            </div>
            <div class="card-body">
                {{ comment.content }}
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:['comments'],
}
</script>

<style>
.spacing{
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>

