<template>
  <admin>
    <h2>{{pageTitle}}</h2>
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

<style></style>