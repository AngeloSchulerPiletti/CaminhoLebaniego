<template>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <div class="right">
      <button class="btn_4" v-if="!logged" @click="$router.go(-1)">voltar</button>
      <button class="btn_4" v-if="logged">criar artigo</button>
      <button class="btn_4" v-if="logged">alterar páginas</button>
      <button class="btn_4" @click="logout" v-if="logged">logout</button>
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
  grid-template-columns: 2fr 7fr;
  padding: 1.2vw 5vw 2vw 2vw;
  gap: 3vw;
  background: linear-gradient($red, transparent);
  margin-bottom: 10vh;

  #logo_container {
    @include headerLogo(0);
  }
  .right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 40px;

    button {

    }
  }
}
</style>
