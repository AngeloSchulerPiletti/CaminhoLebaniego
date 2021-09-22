<template>
  <header>
    <h1>AQUI é o HEADER</h1>
    <button @click="logout" v-if="logged">LOGOUT</button>
  </header>
</template>

<script>
import { api, setAuthorizationToken } from "@/service/api";
export default {
  data() {
    return {
      logged: false,
    };
  },
  computed: {
    tokenAndUser() {
      return this.$store.state.sessionData.user &&
        this.$store.state.sessionData.token
        ? true
        : false;
    },
  },
  watch: {
    tokenAndUser: {
      immediate: true,
      handler(newVal) {
        this.logged = newVal ? true : false;
      },
    },
  },
  methods: {
    logout() {
      var authorizedRequest = setAuthorizationToken(
        this.$store.state.sessionData.token,
        api
      );

      authorizedRequest.post("logout").then((response) => {

        this.$store.commit("setSessionData", {
          user: undefined,
          token: undefined,
        });

        this.$router.push("/caminho");
      });
    },
  },
};
</script>

<style lang="scss" scoped>
button {
  color: $white;
}
</style>
