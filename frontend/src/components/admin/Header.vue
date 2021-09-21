<template>
  <header v-if="show">
    <h1>AQUI é o HEADER</h1>
    <button @click="logout">LOGOUT</button>
  </header>
</template>

<script>
import api from "@/service/api";
export default {
  data(){
    return{
      show: false,
    }
  },
  computed:{
    tokenAndUser(){
      return (this.$store.state.sessionData.user && this.$store.state.sessionData.token) ? true : false;
    }
  },
  watch:{
    tokenAndUser: {
      immediate: true,
      handler(newVal){
        console.log('computed: '+newVal);
        this.show =  newVal ? true : false;
      }
    }
  },
  methods: {
    logout() {
      api.interceptors.request.use(
        (config) => {
          config.headers.Authorization = `Bearer ${this.$store.state.sessionData.token}`;
          return config;
        },
        (error) => {
          return Promise.reject(error);
        }
      );
      api.post("/logout").then(response => {
        if (response.status >= 200 && response.status < 300) {
          this.$store.commit("setSessionData", {
            user: undefined,
            token: undefined,
          });
        }
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
