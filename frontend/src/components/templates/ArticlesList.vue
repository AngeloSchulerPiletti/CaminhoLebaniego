<template>
  <section class="wrapper">
    <div class="title" v-if="title">
      <h1 class="title2">{{ title }}</h1>
    </div>
    <div v-if="articlesList === false" class="problem">
      Tivemos um problema ao carregar os artigos
    </div>
    <div v-else-if="Object.keys(articlesList).length < 1" class="loading">
      Carregando...
    </div>
    <div v-else class="list_container">
      <div
        :class="'card ' + canControll"
        v-for="(article, index) in articlesList"
        :key="index"
      >
        <div class="content_container">
          <h2 class="title3-2" @click="goToArticle(article.url)">
            {{ article.title }}
          </h2>
          <p class="simple_p">{{ article.description }}</p>
          <div class="tags_container">
            <span
              class="badge_1"
              @click="searchFor(tag)"
              v-for="tag in article.tags"
              :key="tag"
              >{{ tag }}</span
            >
          </div>
        </div>
        <div
          v-if="$store.state.logged && canControll"
          class="controll_container"
        >
          <ul>
            <li @click="callControll('deletar-artigo', article.id)" v-if="$route.name == 'alterar_artigos' || $route.name == 'drafts'">Deletar</li>
            <li @click="askForEdit(article.id)" v-if="$route.name != 'trash'">Editar</li>
            <li @click="callControll('restaurar-artigo', article.id)" v-if="$route.name == 'trash'">Restaurar</li>
            <li @click="callControll('excluir-artigo', article.id)" v-if="$route.name == 'trash'">Excluir</li>
            <li @click="callControll('publicar-artigo', article.id)" v-if="$route.name == 'drafts'">Publicar</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { apiRequestProtocol } from "@/service/api.js";

export default {
  data() {
    return {
      page: 1,
      perpage: 10,
      articlesList: {},
      query: "todos",
    };
  },
  mounted() {
    if (this.$route.params.query) {
      this.query = this.$route.params.query;
    }
    this.requestArticleList();
  },
  methods: {
    requestArticleList() {
      let status = this.status ? this.status : "";
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .get(
          `lista-de-artigos/${this.query}/${this.page}/${this.perpage}/${status}`
        )
        .then((response) => {
          this.articlesList = response.data;
        })
        .catch((error) => {
          this.articlesList = false;
        });
    },
    goToArticle(url) {
      this.$router.push({ name: "artigo-show", query: { titulo: url } });
    },
    searchFor(tag) {
      this.$router.push({
        name: "search_result",
        params: { query: tag },
      });
    },
    callControll(action, articleId) {
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .get(`${action}/${articleId}`)
        .then((response) => {
          this.$router.go(0);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    askForEdit(articleId){
      this.$router.push({name: 'criar_artigos', params: {articleId: articleId, pageTitle: "Editar Artigo"}});
    },
  },
  watch: {
    "this.$route.params.query"(newval) {
      console.log("watched: " + newval);
      this.query = newval;
    },
  },
  props: {
    canControll: Boolean,
    title: String,
    status: Number,
  },
};
</script>

<style lang="scss" scoped>
.title {
  margin: 0 5vw;
}
.problem, .loading{
  @include Font1_I;
  color: $white;
  font-size: 20px;
  margin: 0 4vw;
}
.list_container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 3vw;
  padding: 5vw 0;

  .card {
    box-shadow: 0 0 0.8vw 0.3vw #000;
    width: 80%;
    display: flex;
    padding: 1vw;
    background-color: darken($white, 5%);

    .content_container {
      display: flex;
      flex-direction: column;
      gap: 1vw;
      h2 {
        cursor: pointer;
      }
      p {
        cursor: default;
      }
      .tags_container {
        display: flex;
        gap: 1vw;
        span {
          font-size: 12px;
          background-color: $red;
          color: $white;
        }
      }
    }
    .controll_container {
      border-left: 2px solid $red;
      padding-left: 1vw;
      margin-left: 1vw;

      ul {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 1vw;
        height: 100%;

        li {
          cursor: pointer;
          @include Font0;

          &:hover {
            color: $red;
            text-decoration: underline;
          }
        }
      }
    }

    &.false {
      position: relative;
      &::after,
      &::before {
        content: "";
        position: absolute;
        height: 80%;
        top: 50%;
        transform: translateY(-50%);
        border: 1px solid $red;
        z-index: -1;
        width: 10vw;
        transition: left 200ms ease-in, right 200ms ease-in;
      }
      &::before {
        left: 0;
      }
      &::after {
        right: 0;
      }
      &:hover::before {
        left: -4vw;
      }
      &:hover::after {
        right: -4vw;
      }
    }
  }
}
</style>
