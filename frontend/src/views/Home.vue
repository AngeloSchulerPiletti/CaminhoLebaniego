<template>
  <app-layout backID="0">
    <template v-slot:header_sec>
      <div id="bannerContent">
        <h1>{{ pageData["title"] }}</h1>
        <p>{{ pageData["paragraph"] }}</p>
      </div>
      <div id="actions">
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

export default {
  name: "inicio",
  inject: ["URL_API"],
  methods: {},
  props: {
    pageData: Object,
  },
  components: {
    AppLayout,
  },
};
</script>

<style lang="scss" scoped>
@include bannerContent;

#actions {
  position: absolute;
  bottom: 20%;
  right: 10vw;

  .btn_1 {
    background-color: $red;
    @include Font1;
    color: $white;
    font-size: 24px;
    padding: 15px 40px;
    border-radius: 12px;
    box-shadow: 0px 0px 15px $black;
    animation: movingY 600ms ease-in-out 0ms infinite alternate-reverse both;
    transition: color 200ms, background-color 300ms;

    &:hover {
      animation-play-state: paused;
      background-color: $white;
        color: $red;
    }
  }
}
</style>
