<template>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <div class="right">
      
      <button @click="logout" v-if="logged">LOGOUT</button>
    </div>
  </header>
</template>

<script>
import HeaderLogo from "@/components/SVGs/HeaderLogo.vue";
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
  components: {
    HeaderLogo,
  },
};
</script>

<style lang="scss" scoped>
header {
  display: grid;
  grid-template-columns: 1fr 3fr;
  padding: 1.2vw 2vw 2vw 2vw;
  gap: 3vw;
  background: linear-gradient($red, transparent);

  #logo_container {
    @include headerLogo(0);
  }
  .right {
    button {
      color: $white;
    }
  }
}
</style>
