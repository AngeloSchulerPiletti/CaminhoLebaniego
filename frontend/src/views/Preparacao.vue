<template>
  <app-layout backID="1">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData"/>
    </template>
    <template v-slot:main>
      <section id="sec1">
        <listing-topics :total="pageData.topicsList[1]" :content="pageData.topicsList[0]" />
      </section>
    </template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";
import ListingTopics from "@/components/templates/ListingTopics";
 
export default {
  name: "preparacao",
  inject: ["URL_API"],
  methods: {
  },
  created(){
    this.$store.commit('setTitle', "Preparação");
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
    ListingTopics,
  },
};
</script>

<style lang="scss" scoped>
</style>