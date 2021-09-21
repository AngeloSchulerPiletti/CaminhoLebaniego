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
  mounted(){
      console.log(localStorage);
  },
  methods: {
    submit: (scope) => {
      console.log("submitado");

      api.post("login", scope.formUser).then((response) => {
          if (response.status === 200) {
            scope.$store.state.user = response.data.user;
            console.log(scope.$store.state.user);
          }
        console.log(response);
        localStorage.token = response.data.token ? response.data.token : localStorage.token;

        api.interceptors.request.use(
          (config) => {
            config.headers.Authorization = `Bearer ${localStorage.token}`;
            return config;
          },
          (error) => {
            return Promise.reject(error);
          }
        );
        console.log(localStorage);
        api.get("teste", { token: response.data.token }).then(console.log);
      });
    },
  },
  components: {
    Admin,
  },
};
</script>

<style></style>
