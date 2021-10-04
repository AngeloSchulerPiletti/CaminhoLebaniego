<template>
  <div>
    <header-component />
    <error-handle />
    <main>
      <h2 v-if="pageTitle" class="title4">{{ pageTitle }}</h2>
      <slot></slot>
    </main>
    <lateral-menu-bottom v-if="$route.name != 'login'" :locations="admin_links" />
  </div>
</template>

<script>
import Header from "@/components/admin/Header";
import LateralMenuBottom from "@/components/LateralMenuBottom";
import ErrorHandle from "@/components/ErrorHandle";

export default {
  data() {
    return {
      admin_links: [
        { name: "trash", button: "Lixeira" },
        { name: "drafts", button: "Rascunhos" },
      ],
    };
  },   
  components: {
    "header-component": Header,
    LateralMenuBottom,
    ErrorHandle,
  },
  props: {
    pageTitle: String,
  },
};
</script>

<style lang="scss">
main {
  margin: 10vh 0;

  h2 {
    padding: 0 4vw;
    margin-bottom: 4vw;
  }
}
</style>
