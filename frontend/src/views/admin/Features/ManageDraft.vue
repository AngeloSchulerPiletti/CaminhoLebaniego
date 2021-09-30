<template>
<div>
    <articles-list :canControll="true" :status="2"/>
</div>
</template>

<script>
import ArticlesList from "@/components/templates/ArticlesList";
export default {
      components:{
            ArticlesList,
      }
}
</script>

<style lang="scss" scoped>

</style>