<template>
  <admin :pageTitle="editation ? 'Editar Artigo' : 'Criar Artigo'">
    <info-modal :whichInfo="whichInfo" @modalClosed="whichInfo = ''" />
    <div v-if="editation">
      <div class="loading" v-if="loadStatus == 1">
        Carregando...
      </div>
      <div class="problem" v-else-if="loadStatus == 2">
        Tivemos um problema ao carregar os artigos
      </div>
    </div>
    <div v-if="!editation || loadStatus < 1">
      <form @submit.prevent>
        <div class="inputs">
          <div class="input_container">
            <label for="title" @click="whichInfo = 'title'"
              >Título do Artigo</label
            >
            <input
              type="text"
              id="title"
              name="title"
              placeholder="Exemplo de Título"
              v-model="article.title"
              @input="counter.actual.title = article.title.length"
            />
            <span :class="'counter ' + checkMaxLength('title')"
              >{{ counter.actual.title }}/150</span
            >
          </div>
          <div class="input_container">
            <label for="description" @click="whichInfo = 'description'"
              >Descrição</label
            >
            <textarea
              name="description"
              id="description"
              placeholder="Adicione aqui uma descrição para o seu artigo!"
              v-model="article.description"
              @input="counter.actual.description = article.description.length"
            ></textarea>
            <span :class="'counter ' + checkMaxLength('description')"
              >{{ counter.actual.description }}/254</span
            >
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
              @input="counter.actual.tags = article.tags.length"
            />
            <span :class="'counter ' + checkMaxLength('tags')"
              >{{ counter.actual.tags }}/800</span
            >
          </div>
          <div class="input_container">
            <label for="draft" @click="whichInfo = 'draft'"
              >Salvar como Rascunho?</label
            >
            <select name="draft" id="draft" v-model="article.draft">
              <option value="on">Sim</option>
              <option value="off" selected>Não</option>
            </select>
          </div>
          <div class="input_container">
            <label @click="whichInfo = 'images'"
              >Adicione as Imagens Zipadas ao Artigo</label
            >
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
            {{ editation ? "Editar" : "Criar" }}
          </button>
        </div>
      </form>
    </div></admin
  >
</template>

<script>
import { apiRequestProtocol } from "@/scripts/service/api.js";
import Admin from "@/views/layouts/Admin";
import InfoModal from "@/components/admin/InfoModal";

export default {
  data() {
    return {
      article: {
        title: "",
        description: "",
        text: "",
        tags: "",
        draft: "off",
      },
      images: null,
      disabled: "",
      whichInfo: "",
      counter: {
        actual: {
          title: 0,
          description: 0,
          tags: 0,
        },
        max: {
          title: 150,
          description: 254,
          tags: 800,
        },
      },
      loadStatus: 1,
    };
  },
  computed: {
    articleId() {
      return this.$route.params.articleId;
    },
  },
  watch: {
    articleId: {
      immediate: true,
      handler(newval) {
        if (newval) this.requestArticleToEdit(newval);
      },
    },
  },
  methods: {
    checkMaxLength(type) {
      return this.counter.actual[type] > this.counter.max[type] ? "_over" : "";
    },
    submit() {
      if (this.articleId) {
        this.edit();
      } else {
        this.create();
      }
    },
    clean() {
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
      this.loadStatus = 1;
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .get(`artigo-pelo-id/${articleId}`)
        .then((response) => {
          if (response.data.error) {
            this.$store.commit("setErrors", response.data.error);
            this.loadStatus = 2;
            return;
          }
          this.article.title = response.data.title;
          this.article.description = response.data.description;
          this.article.tags = response.data.tags;
          this.article.text = response.data.unformatted_text;
          this.loadStatus = 0;
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
          this.$store.commit("setTitle", "Admin");
          this.disabled = "";
          response.data.error
            ? this.$store.commit("setErrors", response.data.error)
            : null;
          response.data.messages
            ? this.$store.commit("setMessages", response.data.messages)
            : null;
        })
        .catch((err) => {
          this.$store.commit("setTitle", "Admin");
          this.$store.commit("setErrors", [err]);
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
          this.$store.commit("setTitle", "Admin");
          response.data.error
            ? this.$store.commit("setErrors", response.data.error)
            : null;
          response.data.messages
            ? this.$store.commit("setMessages", response.data.messages)
            : null;
          this.disabled = "";
        })
        .catch((err) => {
          this.$store.commit("setErrors", [err]);
        });
    },
  },
  props: {
    editation: Boolean,
  },
  components: {
    Admin,
    InfoModal,
  },
};
</script>

<style lang="scss" scoped>
.problem,
.loading {
  @include Font1_I;
  color: $white;
  font-size: 20px;
  margin: 0 4vw;
}
form {
  @include form1(50vw, 700px);

  .input_container {
    label {
      cursor: pointer;
      position: relative;
      padding-left: 6px;

      transition: padding-left 200ms;

      &::before {
        position: absolute;
        content: "";
        height: 100%;
        left: 0;
        top: 0;
        width: 3px;
        background-color: $red;

        transition: width 200ms;
      }

      &:hover {
        padding-left: 12px;

        &::before {
          width: 10px;
        }
      }
    }
  }
}
</style>
