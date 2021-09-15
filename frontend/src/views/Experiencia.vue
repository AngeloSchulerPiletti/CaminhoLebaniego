<template>
  <app-layout backID="3">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData"/>
    </template>
    <template v-slot:main><h1>ISSO É A main</h1></template>
  </app-layout>
</template>

<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";

export default {
  name: "experiencia",
  inject: ["URL_API"],
  methods: {},
  created(){
    this.$store.commit('setTitle', "Experiência");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
  },
};
</script>

<style lang="scss" scoped>
</style>
