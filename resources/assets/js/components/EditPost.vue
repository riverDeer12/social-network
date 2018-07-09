<template>
    <div class="container-fluid">
        <div class="row">
            <div class="form-group col-md-12">
                <textarea class="form-control" name="content" id="content" v-model="editPost.content"></textarea>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success float-right" @click="update_post()">
                Edit post !
            </button>
        </div>
    </div>
</template>

<script>
export default {
  props: ["post_id"],

  data() {
    return {
      editPost: {}
    };
  },

  mounted(){
    this.get_post();
  },

  http: {
    root: "/root",
    headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") }
  },

  methods: {
    update_post() {
      this.$http.put("/posts/" + this.post_id, {
          content: this.editPost.content
        })
        .then(response => {
          console.log(response);
        });
    },

    get_post() {
      this.$http.get("/posts/" + this.post_id + "/edit").then(response => {
        this.editPost = response.body;
      });
    }
  }
};
</script>

<style scoped>
</style>