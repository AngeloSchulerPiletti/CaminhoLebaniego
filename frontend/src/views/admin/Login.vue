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
import { api } from "@/service/api.js";

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

      api.post("login", this.formUser).then((response) => {
        this.disabled = "";

        if (response.status >= 200 && response.status < 300) {
          this.$store.commit("setSessionData", {
            user: response.data.user,
            token: response.data.token,
          });

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
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: fit-content;
    margin: auto;
    width: 50vw;
    max-width: 400px;

    h1{
      position: relative;
      z-index: 10;
    }
    .inputs {
      display: flex;
      flex-direction: column;
      gap: 30px;
      padding: 2vw;
      background-color: $white;
      border-radius: 10px;
      box-shadow: 0px 0px 3vw 1.5vw $blackest;

      .input_container {
        @include Font0;
        display: flex;
        flex-direction: column;
        gap: 5px;

        label {
          font-size: 14px;
        }
        input {
          font-size: 16px;
          padding: 4px;
          border: none;
          border-bottom: 1px solid $black;

          &:target,
          &:focus {
            border-bottom: 1px solid $red;
          }
        }
      }
    }
    .actions {
      display: flex;
      justify-content: space-between;

      // button {
      // }
    }
  }
}
</style>
