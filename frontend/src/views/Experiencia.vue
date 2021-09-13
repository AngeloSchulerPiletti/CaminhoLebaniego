<template>
  <app-layout backID="3">
    <template v-slot:header_sec><h1>ISSO É O header_sec</h1></template>
    <template v-slot:main><h1>ISSO É A main</h1></template>
  </app-layout>
</template>
<script>

// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";

export default {
  name: "experiencia",
  inject: ["URL_API"],
  methods: {},
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
