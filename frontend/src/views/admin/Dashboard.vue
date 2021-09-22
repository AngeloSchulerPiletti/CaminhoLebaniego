<template>
  <admin>
    <h2 class="title4">{{pageTitle}}</h2>
    <router-view></router-view>
  </admin>
</template>

<script>
import Admin from "@/layouts/Admin";

export default {
  computed:{
    pageTitle(){
      return this.$route.meta.title;
    }
  },
  components: {
    Admin,
  },
};
</script>

<style lang="scss" scoped>
h2{
  padding: 0 4vw;
  margin-bottom: 4vw;
}
</style>