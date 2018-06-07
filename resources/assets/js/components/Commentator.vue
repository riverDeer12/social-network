<template>
    <div>
        <new-comment @sendcomment="post_comment" ></new-comment>
        <comments-feed :comments="comments"></comments-feed>
    </div>
</template>

<script>
import NewComment from "./NewComment.vue";
import CommentsFeed from "./CommentsFeed.vue";

export default {
  props: ["comments", "post_id"],

  components: {
    NewComment,
    CommentsFeed
  },

  http: {root: "/root",headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") }},

  methods: {
    post_comment(comment) {
      this.$http.post("/comments/new_comment", {
          post_id: this.post_id,
          content: comment
        }).then(response => {
          this.$emit("newcomment", response.body);
          this.$swal({
            type: "success",
            text: "Your new comment is successfully created",
            confirmButtonColor: "#218838"
          });
        });
    }
  }
};
</script>
