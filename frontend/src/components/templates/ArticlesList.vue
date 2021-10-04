<template>
  <section class="wrapper" id="articles_list-component">
    <div class="title" v-if="title">
      <h1 class="title2">{{ title }}</h1>
    </div>
    <div class="controlls">
      <label
        >Artigos por página
        <select
          v-model="perpage"
          @change="
            page = 1;
            requestArticleList();
          "
        >
          <option value="4">4</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
        </select>
      </label>
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
            <li
              @click="callControll('deletar-artigo', article.id)"
              v-if="$route.name == 'alterar_artigos' || $route.name == 'drafts'"
            >
              Deletar
            </li>
            <li @click="askForEdit(article.id)" v-if="$route.name != 'trash'">
              Editar
            </li>
            <li
              @click="callControll('restaurar-artigo', article.id)"
              v-if="$route.name == 'trash'"
            >
              Restaurar
            </li>
            <li
              @click="callControll('excluir-artigo', article.id)"
              v-if="$route.name == 'trash'"
            >
              Excluir
            </li>
            <li
              @click="callControll('publicar-artigo', article.id)"
              v-if="$route.name == 'drafts'"
            >
              Publicar
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div v-if="totalArticles>0" class="pagination">
      <span
        @click="
          page = 1;
          requestArticleList();
        "
        v-show="page > 2"
        >{{ 1 }}</span
      >
      <p v-show="page > 2">...</p>
      <span
        @click="
          page -= 1;
          requestArticleList();
        "
        v-show="page > 1"
        >{{ page - 1 }}</span
      >
      <span class="actual">{{ page }}</span>
      <span
        @click="
          page += 1;
          requestArticleList();
        "
        v-show="page < totalPages"
        >{{ page + 1 }}</span
      >
      <p v-show="page < totalPages - 1">...</p>
      <span
        @click="
          page = totalPages;
          requestArticleList();
        "
        v-show="page < totalPages - 1"
        >{{ totalPages }}</span
      >
    </div>
  </section>
</template>

<script>
import { apiRequestProtocol } from "@/service/api.js";
import { scrollToSec } from "@/modules/scrolling.js";

export default {
  data() {
    return {
      page: 1,
      perpage: 10,
      totalArticles: 0,
      articlesList: {},
      query: "todos",
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.totalArticles / this.perpage);
    },
  },
  mounted() {
    if (this.$route.params.query) {
      this.query = this.$route.params.query;
    }
    this.requestArticleList();
  },
  methods: {
    requestArticleList() {
      scrollToSec(this.$el.id, document, 40);
      let status = this.status ? this.status : "";
      let token = this.$store.state.logged
        ? this.$store.state.sessionData.token
        : null;
      apiRequestProtocol(token)
        .get(
          `lista-de-artigos/${this.query}/${this.page}/${this.perpage}/${status}`
        )
        .then((response) => {
          this.articlesList = response.data.articlesList;
          this.totalArticles = response.data.totalArticles;
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
    askForEdit(articleId) {
      this.$router.push({
        name: "criar_artigos",
        params: { articleId: articleId, pageTitle: "Editar Artigo" },
      });
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
  margin-bottom: 2vw;
}
.controlls {
  margin-right: 5vw;
  margin-left: auto;
  width: fit-content;
  label {
    @include Font1;
    color: $white;
  }
}
.problem,
.loading {
  @include Font1_I;
  color: $white;
  font-size: 20px;
  margin: 0 4vw;
}
.list_container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3vw;
  padding: 0vw 3vw;
  padding-top: 2vw;

  .card {
    box-shadow: 0 0 0.8vw 0.3vw #000;
    display: flex;
    padding: 1.2vw 1.8vw;
    background-color: darken($white, 5%);
    border-radius: 5px;

    .content_container {
      display: flex;
      flex-direction: column;
      gap: 1vw;
      h2 {
        cursor: pointer;
        font-size: 26px;
      }
      p {
        cursor: default;
      }
      .tags_container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
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
        left: -1vw;
      }
      &:hover::after {
        right: -1vw;
      }
    }
  }
}
.pagination {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 4vw;
  align-items: center;

  span {
    cursor: pointer;
    @include Font0;
    font-family: Arial, Roboto, sans-serif;
    color: $white;
    font-size: 18px;
    text-decoration: underline;
    transition: color 300ms;

    &.actual {
      font-size: 24px;
      text-decoration: none;
      color: $red;
    }
    &:hover {
      color: $red;
    }
  }
  p {
    @include Font0;
    color: $white;
    font-size: 18px;
  }
}
</style>
