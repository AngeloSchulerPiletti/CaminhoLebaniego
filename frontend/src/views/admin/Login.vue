<template>
  <admin>
    <div id="login_container">
      <form @submit.prevent="submit(this)">
        <h1 class="title4">Login</h1>
        <div class="inputs">
          <div class="input_container">
            <label for="email">Email</label>
            <input
              v-model="formUser.email"
              type="email"
              name="email"
              id="email"
              placeholder="exemplo@gmail.com"
            />
          </div>
          <div class="input_container">
            <label for="password">Senha</label>
            <input
              v-model="formUser.password"
              type="password"
              name="password"
              id="password"
              placeholder="SquarqsmasnaoSquins"
            />
          </div>
        </div>
        <div class="actions">
          <button :class="'btn_3 ' + disabled" type="submit">Acessar</button>
        </div>
      </form>
    </div>
  </admin>
</template>

<script>
import Admin from "@/layouts/Admin";
import { apiRequestProtocol } from "@/service/api.js";

export default {
  name: "login",
  data() {
    return {
      formUser: {
        email: "",
        password: "",
      },
      disabled: "",
    };
  },
  methods: {
    submit: function() {
      console.log("submitado");
      this.disabled = "disabled";

      apiRequestProtocol().post("login", this.formUser).then((response) => {
        this.disabled = "";

        if (response.status >= 200 && response.status < 300) {
          this.$store.commit("setSessionData", {
            user: response.data.user,
            token: response.data.token,
            logged: true,
          });

          // setAuthorizationToken(
          //   response.data.token,
          //   api_instance
          // );

          this.$router.push("/area-do-administrador");
        }
      });
    },
  },
  components: {
    Admin,
  },
};
</script>

<style lang="scss">
#login_container {
  form {
    @include form1;
  }
}
</style>
