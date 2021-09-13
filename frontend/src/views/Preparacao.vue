<template>
  <app-layout backID="1">
    <template v-slot:header_sec>
      <div id="bannerContent">
        <h1>{{ pageData["title"] }}</h1>
        <p>{{ pageData["paragraph"] }}</p>
      </div></template>
    <template v-slot:main><h1>ISSO É A main</h1></template>
  </app-layout>
</template>
<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
 

export default {
  name: "preparacao",
  inject: ["URL_API"],
  methods: {
  },
  mounted() {
    console.log(this.pageData);
  },
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
  },
};
</script>

<style lang="scss" scoped>
@include bannerContent;
</style>