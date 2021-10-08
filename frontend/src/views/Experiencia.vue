<template>
  <app-layout backID="3">
    <template v-slot:header_sec>
      <banner-content :hasArrow="true" :pageData="pageData" />
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
import AppLayout from "@/views/layouts/Public.vue";
import BannerContent from "@/components/Header/BannerContent.vue";
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
  margin-top: 100px;
  border: 1px solid $red;
  width: 80%;
  margin: 6vw auto;
  padding: 20px 35px;
  box-sizing: border-box;

  h3 {
    margin-bottom: 10px;
  }
  p {
    color: $white;
    font-size: 17px;
    margin: auto;
    text-align: justify;
  }
}




@media (max-width: 600px){
  .top {
  width: 86%;
  margin: 90px auto 50px auto;

  h3 {
    font-size: 30px;
  }
  p {
    font-size: 17px;
  }
}
}




@media (max-width: 400px){
  .top {
  width: 80%;
  padding: 18px 28px;

  h3 {
    font-size: 25px;
  }
  p {
    font-size: 17px;
  }
}
}
</style>
