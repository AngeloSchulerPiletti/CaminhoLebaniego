<template>
  <section class="wrapper">
    <div v-if="!articlesList">
        Tivemos um problema ao carregar os artigos
    </div>
    <div v-else-if="Object.keys(articlesList) < 1">
        Carregando...
    </div>
    <div v-else class="list_container">
        <div v-for="(article, index) in articlesList" :key="index" @click="goToArticle(article.url)">
            <h2>{{article.title}}</h2>
            <p>{{article.description}}</p>
            <div class="tags container">
              <span @click="searchFor(tag)" v-for="tag in article.tags" :key="tag">{{tag}}</span>
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
    };
  },
  mounted() {
    this.requestArticleList();
  },
  methods: {
    requestArticleList() {
      apiRequestProtocol()
        .get(`lista-de-artigos/${this.page}/${this.perpage}`)
        .then((response) => {
            this.articlesList = response.data;
            console.log(response.data);
        })
        .catch((error) => {
            this.articlesList = false;
        });
    },
    goToArticle(url){
        this.$router.push({name: 'artigo-show', query: { titulo: url }});
    },
    searchFor(tag){

    },
  },
  props: {},
};
</script>

<style lang="scss" scoped></style>
