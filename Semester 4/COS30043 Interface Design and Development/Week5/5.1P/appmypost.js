const app = Vue.createApp({
    data() {
      return {
        statPosts: [],
        strStatus: "",
      };
    },
    methods: {
      add() {
        this.statPosts.unshift(this.strStatus);
        this.strStatus = "";
      },
      remove(index) {
        this.statPosts.splice(index, 1);
      },
    },
  });
  app.mount("#app");