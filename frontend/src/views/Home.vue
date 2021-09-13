<template>
  <app-layout backID="0">
    <template v-slot:header_sec>
      <h1>ISSO É O header_sec</h1>
    </template>
  </app-layout>
</template>

<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
 

export default {
  name: "inicio",
  inject: ["URL_API"],
  methods: {
  },
  mounted() {
    this.axios.get(`${this.URL_API}${this.$route.name}`).then(response => (console.log(response.data)));
  },
  components: {
    AppLayout,
  },
};
</script>

<style lang="scss" scoped>

</style>
