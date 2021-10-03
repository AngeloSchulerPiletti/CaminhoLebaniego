<template>
  <admin pageTitle="Criar Artigo">
    <info-modal :whichInfo="whichInfo" @modalClosed="whichInfo = ''"/>
    <div>
      <form @submit.prevent>
        <div class="inputs">
          <div class="input_container">
            <label for="title" @click="whichInfo = 'title'">Título do Artigo</label>
            <input
              type="text"
              id="title"
              name="title"
              placeholder="Exemplo de Título"
              v-model="article.title"
            />
          </div>
          <div class="input_container">
            <label for="description" @click="whichInfo = 'description'">Descrição</label>
            <textarea
              name="description"
              id="description"
              placeholder="Adicione aqui uma descrição para o seu artigo!"
              v-model="article.description"
            ></textarea>
          </div>
          <div class="input_container">
            <label for="text" @click="whichInfo = 'article'">Artigo</label>
            <textarea
              name="text"
              id="text"
              placeholder="Escreva seu artigo conforme as regras de formatação pré-estabelecidas"
              v-model="article.text"
            ></textarea>
          </div>
          <div class="input_container">
            <label for="tags" @click="whichInfo = 'tags'">TAGS do Artigo</label>
            <input
              type="text"
              id="tags"
              name="tags"
              placeholder="Insira tags, separando-as por vírgula"
              v-model="article.tags"
            />
          </div>
          <div class="input_container">
            <label for="draft" @click="whichInfo = 'draft'">Salvar como Rascunho?</label>
            <select name="draft" id="draft" v-model="article.draft">
              <option value="on">Sim</option>
              <option value="off" selected>Não</option>
            </select>
          </div>
          <div class="input_container">
            <label for="images" @click="whichInfo = 'files'">Adicione as Imagens Zipadas ao Artigo</label>
            <input
              @change="uploadFile"
              type="file"
              name="images"
              id="images"
              accept=".zip,.rar"
            />
          </div>
        </div>
        <div class="actions">
          <button class="btn_3" @click="clean">Limpar</button>
          <button :class="'btn_3 ' + disabled" type="submit" @click="submit">
            {{ articleId ? "Editar" : "Criar" }}
          </button>
        </div>
      </form>
    </div></admin
  >
</template>

<script>
import { apiRequestProtocol } from "@/service/api.js";
import Admin from "@/layouts/Admin";
import InfoModal from "@/components/admin/InfoModal";

export default {
  data() {
    return {
      article: {
        title: "Título de exemplo do artigo",
        description:
          "Essaé uma descrição que serve apenas de exemplo para descrições futuras. Ás vezes podem ser maiores, ou menores. Tudo depende de quem escreve!",
        text: "Test",
        tags:
          "Artigo, Exemplo de artigo, Segundo Artigo, Mais um artigo, Teste",
        draft: "off",
      },
      images: null,
      disabled: "",
      whichInfo: "",
    };
  },
  computed: {
    checkArticleId() {
      return this.articleId;
    },
  },
  watch: {
    checkArticleId: {
      immediate: true,
      handler(newval) {
        if (newval) this.requestArticleToEdit(newval);
      },
    },
  },
  methods: {
    submit() {
      if (this.articleId) {
        this.edit();
      } else {
        this.create();
      }
    },
    clean() {
      console.log("clean");
      this.article = {
        title: null,
        description: null,
        text: null,
        tags: null,
        draft: "off",
      };
    },
    uploadFile(event) {
      this.images = event.target.files[0];
    },
    requestArticleToEdit(articleId) {
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .get(`artigo-pelo-id/${articleId}`)
        .then((response) => {
          this.article.title = response.data.title;
          this.article.description = response.data.description;
          this.article.tags = response.data.tags;
          this.article.text = response.data.unformatted_text;
        });
    },
    create() {
      this.disabled = "disabled";
      this.$store.commit("setTitle", "Enviando Artigo...");

      var formData = new FormData();
      this.images ? formData.append("image", this.images) : null;
      Object.keys(this.article).forEach((input) => {
        this.article[input]
          ? formData.append(input, this.article[input])
          : null;
      });

      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .post("novo-artigo", formData, {
          "Content-type": "multipart/form-data",
        })
        .then((response) => {
          this.disabled = "";
          this.$store.commit("setTitle", "Admin");
        });
    },
    edit() {
      this.disabled = "disabled";
      this.$store.commit("setTitle", "Enviando Artigo...");

      var formData = new FormData();
      this.images ? formData.append("image", this.images) : null;
      Object.keys(this.article).forEach((input) => {
        this.article[input]
          ? formData.append(input, this.article[input])
          : null;
      });

      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .post(`editar-artigo/${this.articleId}`, formData, {
          "Content-type": "multipart/form-data",
        })
        .then((response) => {
          this.disabled = "";
          this.$store.commit("setTitle", "Admin");
        });
    },
  },
  props: {
    articleId: String,
  },
  components: {
    Admin,
    InfoModal,
  },
};
</script>

<style lang="scss" scoped>
form {
  @include form1(50vw, 700px);

  .input_container{
    label{
      cursor: pointer;
      position: relative;
      padding-left: 6px;

      transition: padding-left 200ms;
      
      &::before{
        position: absolute;
        content: "";
        height: 100%;
        left: 0;
        top: 0;
        width: 3px;
        background-color: $red;

        transition: width 200ms;
      }

      &:hover{
        padding-left: 12px;

        &::before{
          width: 10px;
        }
      }
    }
  }
}
</style>
