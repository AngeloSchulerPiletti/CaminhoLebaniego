<template>
  <app-layout backID="0">
    <template v-slot:header_sec>
      <banner-content :pageData="pageData" />
      <div id="actions">
        <div class="btn_1">
          História do Caminho
        </div>
        <router-link to="/preparacao">
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
  mounted(){
    console.log(this.$store.state.teste);
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
  bottom: 20%;
  right: 0;
  left: 0;
  padding: 0 10vw 0 10vw;

  display: flex;
  justify-content: space-between;
  

  .btn_1 {
    background-color: $red;
    @include Font1;
    color: $white;
    font-size: 24px;
    padding: 15px 40px;
    border-radius: 12px;
    box-shadow: 0px 0px 15px $black;
    animation: movingY 800ms ease-in-out 0ms infinite alternate-reverse both;
    transition: color 200ms, background-color 300ms;
    cursor: pointer;

    &:hover {
      animation-play-state: paused;
      background-color: $white;
      color: $red;
    }
  }
}
</style>
