<template>
  <app-layout backID="3">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
    </template>
    <template v-slot:main>
      <div class="top">
        <h3 class="title4">1008,9Km em 32 dias</h3>
        <p>
          Entre 27 de maio e 01 de junho de 2018 fiz minha peregrinação à Santo
          Toríbio, durante a Peregrinação a Santiago de Compostela pelo Caminho
          do Norte.
        </p>
      </div>
      <article-component :article="pageData.article"></article-component>
    </template>
  </app-layout>
</template>

<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";
import Article from "@/components/templates/Article.vue";

export default {
  name: "experiencia",
  methods: {},
  created() {
    this.$store.commit("setTitle", "Experiência");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
    "article-component": Article,
  },
};
</script>

<style lang="scss" scoped>
.top {
  h3 {
    margin: 5vw 10vw 1.5vw 10vw;
  }
  p {
    color: $white;
    font-size: 17px;
    margin: auto;
    width: 80vw;
    text-align: justify;
    padding-bottom: 1.4vw;
    margin-bottom: 4vw;
    border-bottom: 2px solid $red;
    box-shadow: inset 0 -10px 8px -5px $blackest;
  }
}
</style>
