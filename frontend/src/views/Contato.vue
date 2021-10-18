<template>
  <app-layout backID="5">
    <template v-slot:header_sec>
      <banner-content :hasArrow="true" :pageData="pageData" />
    </template>
    <template v-slot:main>
      <div class="form_container">
      <form @submit.prevent>
        <div class="inputs">
          <div class="input_container half">
            <label for="name">Nome Completo</label>
            <input
              type="text"
              name="name"
              id="name"
              v-model="form.name"
              placeholder="Virginia Eliza"
            />
          </div>
          <div class="input_container half">
            <label for="phone">Telefone</label>
            <input
              type="tel"
              name="phone"
              id="phone"
              v-model="form.phone"
              placeholder="+NN DDD XXXXX-XXXX"
            />
          </div>
          <div class="input_container half">
            <label for="email">E-Mail</label>
            <input
              type="email"
              name="email"
              id="email"
              v-model="form.email"
              placeholder="exemplo@exemplo.com"
            />
          </div>
          <div class="input_container">
            <label for="message">Mensagem</label>
            <textarea
              name="message"
              id="message"
              @input="counter.actual.message = form.message.length"
              v-model="form.message"
              placeholder="Digite aqui sua mensagem"
            ></textarea>
            <span :class="'counter ' + checkMaxLength('message')"
              >{{ counter.actual.message }}/1000</span
            >
          </div>
        </div>

        <div class="actions">
          <button :class="'btn_3 ' + disabled" type="submit" @click="submit">
            Enviar
          </button>
        </div>
      </form>
      </div>
    </template>
  </app-layout>
</template>

<script>
import { apiRequestProtocol } from "@/scripts/service/api.js";
import AppLayout from "@/views/layouts/Public.vue";
import BannerContent from "@/components/Header/BannerContent.vue";

export default {
  data() {
    return {
      form: {
        name: "",
        phone: "",
        email: "",
        message: "",
      },
      counter: {
        actual: {
          message: 0,
        },
        max: {
          message: 1000,
        },
      },
      disabled: "",
    };
  },
  methods: {
    submit() {
      apiRequestProtocol()
        .post(`contato/mensagem`, this.form)
        .then((response) => {
          response.data.error ? this.$store.commit('setErrors', response.data.error) : null;
          response.data.messages
            ? this.$store.commit("setMessages", response.data.messages)
            : null;
          this.form = {};
        })
        .catch((err) => {
          this.$store.commit('setErrors', ['Houve um erro ao enviar']);
        });
    },
    checkMaxLength(type) {
      return this.counter.actual[type] > this.counter.max[type] ? "_over" : "";
    },
  },
  created() {
    this.$store.commit("setTitle", "Contato");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
  },
};
</script>

<style lang="scss" scoped>
.form_container{
  margin-top: 100px;
}
form {
  @include form1(80vw, 100vw);
}
</style>
