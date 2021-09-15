<template>
  <app-layout backID="0" :modalContent="pageData['modal']">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
      <div id="actions">
        <div class="btn_1" @click="$store.state.modalShow = true">
          História do Caminho
        </div>
        <router-link to="/caminho">
          <div class="btn_1">
            Primeiros Passos
          </div>
        </router-link>
      </div>
    </template>
  </app-layout>
</template>

<script>
// @ is an alias to /src
import AppLayout from "@/layouts/Public.vue";
import BannerContent from "@/components/header/BannerContent.vue";

export default {
  name: "inicio",
  inject: ["URL_API"],
  methods: {},
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
    BannerContent,
  },
};
</script>

<style lang="scss" scoped>
#actions {
  position: absolute;
  bottom: 16%;
  right: 0;
  left: 0;
  padding: 0 10vw 0 10vw;

  display: flex;
  justify-content: space-between;
  
}
</style>
