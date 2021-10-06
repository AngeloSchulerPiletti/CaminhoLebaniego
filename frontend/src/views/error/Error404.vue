<template>
  <error :error="error">
    <h6 class="title">O que você pode fazer:</h6>
    <ul>
      <li @click="$router.go(-2)">Voltar</li>
      <li @click="$router.push('/')">Página inicial</li>
    </ul>
  </error>
</template>

<script>
import Error from "@/views/error/Error";

export default {
  data() {
    return {
      error: {
        code: "Erro 404",
        message: "Perdão, mas a página solicitada não foi encontrada!",
      },
    };
  },
  created() {
    this.$store.commit("setTitle", "Erro 404");
  },
  components: {
    Error,
  },
};
</script>

<style lang="scss" scoped>
h6{
    margin-bottom: 30px;
    width: fit-content;
    @include Title2;
    color: $white;    
    font-size: 22px;
    position: relative;
    padding-bottom: 4px;

    &::before{
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        border-bottom: 1px solid $red;
        width: 20%;
    }
}
ul {
  @include Font1;
  margin-left: 50px;
  display: flex;
  flex-direction: column;
  gap: 0.5em;

  li {
    cursor: pointer;
    transition: color 300ms;
    color: $white;
    position: relative;
    padding-left: 8px;

    &::before {
      content: "";
      position: absolute;
      border-left: 2px solid $white;
      height: 100%;
      left: 0;
      top: 0;

      transition: border-left 300ms;
    }

    &:hover::before {
      border-left: 2px solid $red;
    }
  }
}
</style>
