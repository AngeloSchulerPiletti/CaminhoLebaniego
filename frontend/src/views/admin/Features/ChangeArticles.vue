<template>
  <admin pageTitle="Alterar Artigos">
    <div>
      <articles-list :canControll="true" /></div
  ></admin>
</template>

<script>
import Admin from "@/layouts/Admin";
import ArticlesList from "@/components/templates/ArticlesList";

export default {
  components: {
    ArticlesList,
    Admin,
  },
};
</script>

<style lang="scss" scoped></style>
