<template>
  <header v-if="this.$store.state.user">
    <h1>AQUI é o HEADER</h1>
    <button @click="logout">LOGOUT</button>
  </header>
</template>

<script>
import api from "@/service/api";
export default {
  methods: {
    logout() {
      api.interceptors.request.use(
        (config) => {
          config.headers.Authorization = `Bearer ${localStorage.token}`;
          return config;
        },
        (error) => {
          return Promise.reject(error);
        }
      );
      api.post("/logout").then(console.log);
    },
  },
};
</script>

<style lang="scss" scoped>
button {
  color: $white;
}
</style>
