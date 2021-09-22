<template>
  <div>
    <form @submit.prevent>
      <div class="inputs">
        <div class="input_container">
          <label for="title">Título do Artigo</label>
          <input
            type="text"
            id="title"
            name="title"
            placeholder="Exemplo de Título"
            v-model="article.title"
          />
        </div>
        <div class="input_container">
          <label for="description">Descrição</label>
          <textarea
            name="description"
            id="description"
            placeholder="Adicione aqui uma descrição para o seu artigo!"
            v-model="article.description"
          ></textarea>
        </div>
        <div class="input_container">
          <label for="text">Artigo</label>
          <textarea
            name="text"
            id="text"
            placeholder="Escreva seu artigo conforme as regras de formatação pré-estabelecidas"
            v-model="article.text"
          ></textarea>
        </div>
        <div class="input_container">
          <label for="tags">TAGS do Artigo</label>
          <input
            type="text"
            id="tags"
            name="tags"
            placeholder="Insira tags, separando-as por vírgula"
            v-model="article.tags"
          />
        </div>
        <div class="input_container">
          <label for="draft">Salvar como Rascunho?</label>
          <select name="draft" id="draft" v-model="article.draft">
            <option value="true">Sim</option>
            <option value="false" selected>Não</option>
          </select>
        </div>
        <div class="input_container">
          <label for="images">Adicione as Imagens Zipadas ao Artigo</label>
          <input
            @change="uploadFile"
            type="file"
            name="images"
            id="images"
          />
        </div>
      </div>
      <div class="actions">
        <button :class="'btn_3 ' + disabled" type="submit" @click="submit">
          Criar
        </button>
        <button class="btn_3" @click="clean">Limpar</button>
      </div>
    </form>
  </div>
</template>

<script>
import Dashboard from "@/views/admin/Dashboard";
import { apiRequestProtocol } from "@/service/api.js";

export default {
  data() {
    return {
      article: {
        title: null,
        description: null,
        text: null,
        tags: null,
        draft: "false",
      },
        images: null,
      disabled: "",
    };
  },
  methods: {
    submit() {
      this.disabled = "disabled";
      this.$store.commit("setTitle", "Enviando Artigo...");

      console.log(this.article);

      var formData = new FormData();
      this.images ? formData.append('image', this.images) : null; 
      Object.keys(this.article).forEach(key => {
        formData.append(key, this.article.key)
      });

      apiRequestProtocol(this.$store.state.sessionData.token)
        .post("novo-artigo", formData, {'Content-type': 'multipart/form-data'})
        .then((response) => {
          this.disabled = "";
          console.log(response);
          this.$store.commit("setTitle", "Admin");
        });
    },
    clean() {
      console.log("clean");
      this.article = {
        title: null,
        description: null,
        text: null,
        tags: null,
        draft: "false",
      };
    },
    uploadFile(event) {
      this.images = event.target.files[0];
    },
  },
  components: {
    Dashboard,
  },
};
</script>

<style lang="scss" scoped>
form {
  @include form1(50vw, 700px);
}
</style>
