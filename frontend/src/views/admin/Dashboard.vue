<template>
  <admin>
    <h2>{{pageTitle}}</h2>
    <router-view></router-view>
  </admin>
</template>

<script>
import Admin from "@/layouts/Admin";

export default {
  name: "dashboard",
  props:{
    pageTitle: String,
  },
  components: {
    Admin,
  },
};
</script>

<style></style>