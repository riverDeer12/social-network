<template>
    <div>
        <commentator :post_id="this.post_id" :comments="comments" @newcomment="push_new_comment"></commentator>
    </div>
</template>
<script>
import Commentator from "./Commentator.vue";

export default {
  props: ["post_id"],

  data() {
    return {
      comments: []
    };
  },

  mounted() {
    this.$http.get("/comments/" + this.post_id).then(response => {
      response.body.forEach(comment => {
        this.comments.push(comment);
      });
    });
  },

  methods: {
      push_new_comment(comment){
          this.comments.push(comment);
      }
  }
};
</script>
<style>
</style>
