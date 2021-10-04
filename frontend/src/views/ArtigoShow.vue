<template>
  <app-layout :isArticle="true">
    <template v-slot:main>
      <share-button v-if="article.status == 1" :url="article.url" />
      <section id="sec1">
        <div class="header"></div>
        <article-component
          :article="article.formatted_text"
          :imgs_path="article.images_path"
          :imgs_names="article.images_names"
        />
      </section>
    </template>
  </app-layout>
</template>

<script>
import Article from "@/components/templates/Article";
import { apiRequestProtocol } from "@/service/api.js";
import Public from "@/layouts/Public";
import ShareButton from "@/components/ShareButton";

export default {
  data() {
    return {
      article: {},
    };
  },
  mounted() {
    var url = this.$route.query.titulo;
    if (!url) {
      this.$router.push({
        name: "error404",
        params: { message: "Houve um mau uso dos parâmetros da URL" },
      });
    } else {
      this.getArticle(url);
    }
  },
  methods: {
    getArticle(url) {
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      this.$store.commit("setTitle", "carregando...");
      apiRequestProtocol(token)
        .get(`artigo/${url}`)
        .then((response) => {
          if (response.data.error) {
            this.$store.commit("setErrors", response.data.error);
            return;
          }
          this.article = response.data;
          this.$store.commit("setTitle", response.data.title);
        })
        .catch((error) => {
          this.$router.push({
            name: "error404",
            params: { message: "Vish, artigo não encontrado..." },
          });
        });
    },
  },
  components: {
    "article-component": Article,
    "app-layout": Public,
    ShareButton,
  },
};
</script>

<style lang="scss" scoped></style>
