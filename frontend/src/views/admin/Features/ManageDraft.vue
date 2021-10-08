<template>
  <admin pageTitle="Seus Rascunhos">
    <div>
      <articles-list :canControll="true" :status="2" /></div
  ></admin>
</template>

<script>
import Admin from "@/views/layouts/Admin";
import ArticlesList from "@/components/templates/ArticlesList";
export default {
  components: {
    ArticlesList,
    Admin,
  },
};
</script>

<style lang="scss" scoped></style>
