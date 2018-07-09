<template>
    <div class="container">
        <div class="text-center" v-if="loading">
            Loading...
        </div>
        <div class="text-center" v-if="wall_count === 0">
            No posts.
        </div>
        <div class="row spacing" v-for="(wall_post, index) in wall" :key="index">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-header">
                        <img class="post-user-image" :src="wall_post.user.avatar">
                        <span>{{ wall_post.user.name }}</span>
                        <!-- Post options dropdown -->
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-dot-circle-o"></i>
                            </button>
                            <div class="dropdown-menu text-center">
                                <button class="dropdown-item" data-toggle="modal"
                                        :data-target="'#editPostModal'+wall_post.id"><i
                                        class="fa fa-pencil"></i> Edit
                                </button>
                                <button class="dropdown-item" @click="delete_post(wall_post)"><i
                                        class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                        <!-- Post options dropdown -->
                        <!-- Edit post modal -->
                        <div class="modal fade" :id="'editPostModal'+wall_post.id" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editing post...</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <edit-post :post_id="wall_post.id"></edit-post>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Edit post modal -->
                    </div>
                    <div class="card-body text-center">
                        {{ wall_post.content }}
                        <hr/>
                        <div class="float-left">
                            <wall-like :id="wall_post.id"></wall-like>
                        </div>
                        <div class="float-right">
                            <span>Posted: {{ moment(wall_post.created_at).fromNow() }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <post-comments :post_id="wall_post.id"></post-comments>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
let moment = require("moment");
import WallLike from "./WallLike";
import EditPost from "./EditPost";

export default {
  created() {
    this.get_wall();
  },

  props: ["user_id"],

  data() {
    return {
      moment: moment,
      loading: true
    };
  },

  computed: {
    wall() {
      return this.$store.getters.wall;
    },

    wall_count() {
      return this.$store.getters.wall_count;
    }
  },

  components: {
    WallLike,
    EditPost
  },

  http: {
    root: "/root",
    headers: { "X-CSRF-Token": $("meta[name=csrf-token]").attr("content") }
  },

  methods: {
    get_wall() {
      this.loading = true;
      this.$http.get("/wall/" + this.user_id).then(response => {
        if (response.bodyText === "[]") {
          this.loading = false;
        }
        response.body.forEach(wall_post => {
          this.$store.commit("add_wall_post", wall_post);
          this.loading = false;
        });
      });
    },

    delete_post(wall_post) {
      this.$http.delete("/posts/" + wall_post.id).then(response => {
        this.$store.commit("remove_post", {
          id: response.body
        });
        this.$swal({
          type: "success",
          text: "Post is successfully deleted",
          confirmButtonColor: "#218838"
        });
      });
    }
  }
};
</script>

<style>
.spacing {
  margin-top: 10px;
  margin-bottom: 10px;
}

.post-user-image {
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
</style>