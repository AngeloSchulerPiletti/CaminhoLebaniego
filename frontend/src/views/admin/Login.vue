<template>
  <admin>
    <div>
      <form @submit.prevent="submit(this)">
        <div class="input_container">
          <label for="email">Email</label>
          <input
            v-model="formUser.email"
            type="email"
            name="email"
            id="email"
          />
        </div>
        <div class="input_container">
          <label for="password">Senha</label>
          <input
            v-model="formUser.password"
            type="text"
            name="password"
            id="password"
          />
        </div>
        <div class="actions">
          <button type="submit">Acessar</button>
        </div>
      </form>
    </div>
  </admin>
</template>

<script>
import Admin from "@/layouts/Admin";
import api from "@/service/api.js";

export default {
  name: "login",
  data() {
    return {
      formUser: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    submit: function() {
      console.log("submitado");

      api.post("login", this.formUser).then((response) => {
        if (response.status >= 200 && response.status < 300) {
          this.$store.commit("setSessionData", {
            user: response.data.user,
            token: response.data.token,
          });
          // this.$store.state.sessionData.user = response.data.user;
          // this.$store.state.sessionData.token = response.data.token;
        }

        api.interceptors.request.use(
          (config) => {
            config.headers.Authorization = `Bearer ${this.$store.state.sessionData.token}`;
            return config;
          },
          (error) => {
            return Promise.reject(error);
          }
        );

        api.get("teste").then(console.log);
      });
    },
  },
  components: {
    Admin,
  },
};
</script>

<style></style>
