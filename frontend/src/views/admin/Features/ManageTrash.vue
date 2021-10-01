<template>
  <admin pageTitle="Lixeira">
    <div>
      <articles-list :canControll="true" :status="3" /></div
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
