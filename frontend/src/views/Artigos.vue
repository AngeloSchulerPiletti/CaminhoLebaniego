<template>
  <app-layout backID="4">
    <template v-slot:header_sec>
      <banner-content :hasArrow="true" :pageData="pageData"/>
    </template>
    <template v-slot:main>
      <articles-list :canControll="false" title="Todos os artigos"/>
    </template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/views/layouts/Public.vue";
import BannerContent from "@/components/Header/BannerContent.vue";
import ArticlesList from "@/components/templates/ArticlesList";

export default {
  name: "artigos",
  methods: {
  },
  created(){
    this.$store.commit('setTitle', "Artigos");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
    ArticlesList,
  },
};
</script>

<style lang="scss" scoped>
</style>