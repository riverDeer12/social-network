<template>
    <div>

    </div>
</template>

<script>
export default {
  mounted() {
    this.listen();
  },

  props: ["id"],

  methods: {
    listen() {
      Echo.private("App.User." + this.id).notification(notification => {
        this.$swal({
          position: "bottom-left",
          text: notification.name + notification.message,
          showConfirmButton: false,
          timer: 3000
        });

        this.$store.commit("add_notification", notification);

        document.getElementById("notification_sound").play();
      });
    }
  }
};
</script>

<style>
</style>