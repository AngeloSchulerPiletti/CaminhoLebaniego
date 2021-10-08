<template>
  <header>
    <div id="logo_container">
      <router-link to="/">
        <header-logo />
      </router-link>
    </div>
    <div class="right">
      <button class="btn_4" v-if="!logged" @click="$router.go(-1)">
        voltar
      </button>
      <button
        class="btn_4"
        @click="$router.push({ name: 'criar_artigos' })"
        v-if="logged"
      >
        criar artigo
      </button>
      <button
        class="btn_4"
        @click="$router.push({ name: 'alterar_artigos' })"
        v-if="logged"
      >
        alterar artigos
      </button>
      <!-- <button class="btn_4" @click="$router.push({name: 'alterar_paginas'})" v-if="logged">alterar páginas</button> -->
      <button class="btn_4" @click="logout" v-if="logged">logout</button>
    </div>
  </header>
</template>

<script>
import HeaderLogo from "@/components/SVGs/HeaderLogo.vue";
import { apiRequestProtocol } from "@/scripts/service/api";

export default {
  data() {
    return {
      logged: false,
    };
  },
  computed: {
    tokenAndUser() {
      return this.$store.state.logged;
    },
  },
  watch: {
    tokenAndUser: {
      immediate: true,
      handler(newVal) {
        this.logged = newVal;
      },
    },
  },
  methods: {
    logout() {
      apiRequestProtocol(this.$store.state.sessionData.token)
        .post("logout")
        .then((response) => {
          this.$store.commit("setSessionData", {
            user: undefined,
            token: undefined,
            logged: false,
          });

          this.$router.push("/caminho");
        })
        .catch((error) => {
          this.$store.commit("setErrors", [
            "Houve um erro ao tentar deslogar, é possível que você já esteja deslogado",
          ]);
          
          this.$store.commit("setSessionData", {
            user: undefined,
            token: undefined,
            logged: false,
          });

          this.$router.go(0);
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
